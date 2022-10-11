<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Filament\Resources\ContactResource\Widgets\ExportWidget;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $modelLabel = 'Contato';

    protected static ?string $navigationLabel = 'Contatos';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nome')
                    ->disabled(),
                TextInput::make('email')
                    ->label('Email')
                    ->disabled(),
                TextInput::make('phone')
                    ->label('Telefone')
                    ->disabled(),
                TextInput::make('form')
                    ->label('Formulário que foi enviado')
                    ->disabled(),
                TextInput::make('quero_maquininha')
                    ->label('Quero a minha maquininha')
                    ->disabled(),
                TextInput::make('quero_vender_online')
                    ->label('Quero vender pela Internet')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nome'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('phone')->label('Telefone'),
                TextColumn::make('form')->label('Formulário que foi enviado')
                    ->enum([
                        'form-peca-a-sua' => 'Peça a sua Maquinha',
                        'form-venda-pela-internet' => 'Venda pela Internet'
                    ]),
            ])
            ->filters([
                Filter::make('form')
                    ->form([
                        Select::make('form')
                            ->label('Formulário')
                            ->options([
                                Contact::FORM_PECA_SUA => 'Peça a sua Maquininha',
                                Contact::FORM_VENDA_PELA_INTERNET => 'Venda pela Internet'

                            ])
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['form'],
                                fn (Builder $query, $value): Builder => $query->where('form', $value),
                            );
                    }),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ExportWidget::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
            'view' => Pages\ViewContact::route('/{record}'),
        ];
    }
}
