<?php

namespace App\Models;

use App\Rules\ValidTaxStructure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantService extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'mcc',
        'description',
        'taxes',
    ];

    protected $casts = [
        'taxes' => 'json',
    ];

    // Regras de validação
    public static $rules = [
        'taxes' => [ValidTaxStructure::class],
    ];

    /**
     * Converte o atributo "taxes" para um array associativo.
     *
     * @param  string  $value
     * @return array
     */
    public function getTaxesAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Define o atributo "taxes" como um JSON.
     *
     * @param  array  $value
     * @return void
     */
    public function setTaxesAttribute($value)
    {
        $this->attributes['taxes'] = json_encode($value);
    }

    public function getMediumTaxes()
    {
        //taxas arredondadas pra cima
        $master = $this->taxes['master'];
        $visa = $this->taxes['visa'];

        $medium = [
            'debit' => round(($master['debit'] + $visa['debit']) / 2, 2),
            'credito_vista' => round(($master['credito_vista'] + $visa['credito_vista']) / 2, 2),
            'credito_parc_2_6' => round(($master['credito_parc_2_6'] + $visa['credito_parc_2_6']) / 2, 2),
            'credito_parc_7_12' => round(($master['credito_parc_7_12'] + $visa['credito_parc_7_12']) / 2, 2),
        ];

        return $medium;
    }

    public function importFromcsv()
    {
        //open costs.csv in storage/public
        $costsFile = fopen(storage_path('app/public/costs.csv'), 'r');
        //headers in second line
        $headers = [
            'mcc', 'description', 'master_debit', 'master_credit_1', 'master_credit_2', 'master_credit_3', 'visa_debit', 'visa_credit_1', 'visa_credit_2', 'visa_credit_3', 'elo_debit', 'elo_credit_1', 'elo_credit_2', 'elo_credit_3'
        ];
        //read all lines
        $costs = [];
        while ($row = fgetcsv($costsFile)) {
            $costs[] = array_combine($headers, $row);
        }
        fclose($costsFile);
        //make mcc as key
        $costs = array_combine(array_column($costs, 'mcc'), $costs);
        //exclude first line
        unset($costs['MCC']);
        //group taxes by vendor (master, visa, elo), followine the structure:
        //$cost[$key]['taxes'][$vendor]['debit'] = $value;
        $vendors = ['master', 'visa', 'elo'];
        foreach ($costs as $key => $value) {
            $costs[$key]['taxes'] = [];
            foreach ($vendors as $vendor) {
                $costs[$key]['taxes'][$vendor] = [
                    'debit' => $value[$vendor . '_debit'],
                    'credit' => [
                        'credito_vista' => $value[$vendor . '_credit_1'],
                        'credito_parc_2_6' => $value[$vendor . '_credit_2'],
                        'credito_parc_7_12' => $value[$vendor . '_credit_3'],
                    ]
                ];
            }
            unset($costs[$key]['master_debit']);
            unset($costs[$key]['master_credit_1']);
            unset($costs[$key]['master_credit_2']);
            unset($costs[$key]['master_credit_3']);
            unset($costs[$key]['visa_debit']);
            unset($costs[$key]['visa_credit_1']);
            unset($costs[$key]['visa_credit_2']);
            unset($costs[$key]['visa_credit_3']);
            unset($costs[$key]['elo_debit']);
            unset($costs[$key]['elo_credit_1']);
            unset($costs[$key]['elo_credit_2']);
            unset($costs[$key]['elo_credit_3']);
        }

        $objs = [];

        foreach ($costs as $element){

            $costClass = new MerchantService();
            $costClass->mcc = $element['mcc'];
            $costClass->description = $element['description'];
            $taxes = new \stdClass();
            //$taxes->median = new \stdClass();

            foreach ($element['taxes'] as $key => $value) {
                //remove '%' from values and cast to float
                $taxes->$key = new \stdClass();
                $taxes->$key->debit = (float) str_replace(['%', ','], ['', '.'], $value['debit']);
                /*if ($key !== 'elo') {
                    //add or sum to 'median' key
                    $taxes->median->debit = isset($taxes->median->debit) ? ($taxes->median->debit + $taxes->$key->debit)/2 : $taxes->$key->debit;
                }*/
                foreach ($value['credit'] as $key2 => $value2) {
                    $taxes->$key->$key2 = (float) str_replace(['%', ','], ['', '.'], $value2);
                    /*if ($key !== 'elo'){
                        //add or sum to 'median' key
                        $taxes->median->$key2 = isset($taxes->median->$key2) ? ($taxes->median->$key2 + $taxes->$key->$key2)/2 : $taxes->$key->$key2;
                    }*/
                }

            }

            $costClass->taxes = $taxes;
            $costClass->save();

            $objs[] = $costClass;

        }

        return response()->json(['objects' => $objs, 'totalObj' => count($objs), 'totalRaw' => count($costs)]);
    }
}
