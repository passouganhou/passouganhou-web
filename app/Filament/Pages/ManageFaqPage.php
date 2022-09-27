<?php

namespace App\Filament\Pages;

use App\Settings\FaqPageSettings;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;

class ManageFaqPage extends SettingsPage
{
    protected static ?string $navigationLabel = 'Maquininhas FAQ';

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = FaqPageSettings::class;

    protected function getFormSchema(): array
    {
        return [
            Card::make(
                [
                    Repeater::make('maquininhas')
                        ->schema([
                            TextInput::make('name')->label('Nome da maquininha')->required(),
                            FileUpload::make('featured_image')
                                ->label('Imagem Maquininha')
                                ->required(),
                            TextInput::make('description')
                                ->label('Texto Descritivo')
                                ->required(),
                            Repeater::make('operation')
                                ->label('Funcionamento')
                                ->schema([
                                    TextInput::make('title')
                                        ->label('Título da etapa')
                                        ->required(),
                                    RichEditor::make('items')
                                        ->label('Itens da etapa')
                                        ->required()
                                        ->disableToolbarButtons([
                                            'attachFiles',
                                            'blockquote',
                                            'link',
                                            'strike',
                                            'h2',
                                            'h3',
                                            'codeBlock',
                                            'bulletList'
                                        ])
                                ])
                                ->columnSpan(2)
                        ])
                        ->columns(2),

                ]

            )
        ];
    }
}
