<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportContact implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{

    public function __construct(public string $filter)
    {
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Contact::query()
            ->when($this->filter !== 'all', function ($query, $value) {
                $query->where('form', $this->filter);
            })
            ->get();
    }

    /**
     * @var Contact $contact
     */
    public function map($contact): array
    {
        return [
            $contact->name,
            $contact->email,
            $contact->phone,
            $contact->quero_maquininha,
            $contact->quero_vender_online,
            $contact->created_at->format('d/m/Y')
        ];
    }

    public function headings(): array
    {
        return [
            'Nome',
            'Email',
            'Telefone',
            'Quero minha maquininha',
            'Quero vender online',
            'Data do envio'
        ];
    }
}
