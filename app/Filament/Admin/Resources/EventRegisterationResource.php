<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EventRegisterationResource\Pages;
use App\Filament\Admin\Resources\EventRegisterationResource\RelationManagers;
use App\Models\EventRegisteration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;

class EventRegisterationResource extends Resource
{
    protected static ?string $model = EventRegisteration::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Registerations';

    public static function getNavigationBadge(): ?string
{
    return static::getModel()::count();
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Event Registeration Details')
                    ->collapsible()
                    ->schema([
                        Select::make('event_id')->required()->relationship('event', 'name')->preload()->searchable(),
                        Select::make('user_id')->required()->relationship('user', 'name')->preload()->searchable(),
                        ToggleButtons::make('status')->options([
                            'pending' => 'Pending',
                            'approved' => 'Approved',
                            'rejected' => 'Rejected'
                        ])->required()->default('pending')->inline()
                        ->colors([
                            'pending' => 'warning',
                            'approved' => 'success',
                            'rejected' => 'danger',
                        ])->icons([
                            'pending' => 'heroicon-o-clock',
                            'approved' => 'heroicon-o-check-circle',
                            'rejected' => 'heroicon-o-x-circle'
                        ]),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('event.name')
                    ->sortable(),
                TextColumn::make('user.name')
                    ->sortable(),
                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEventRegisterations::route('/'),
            'create' => Pages\CreateEventRegisteration::route('/create'),
            'edit' => Pages\EditEventRegisteration::route('/{record}/edit'),
        ];
    }
}
