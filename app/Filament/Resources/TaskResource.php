<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Task;
use App\Models\User;
use Filament\Tables;
use App\Models\Project;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TaskResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TaskResource\RelationManagers;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getForm(): array
    {
        return [
            Select::make('project_id')
                ->label('Project')
                ->options(Project::pluck('name', 'id'))
                ->required()
                ->searchable(),
            Select::make('user_id')
                ->label('Assigned To')
                ->options(User::pluck('name', 'id'))
                ->searchable()
                ->required(),
            TextInput::make('title')->required(),
            Textarea::make('description'),
            Select::make('status')
                ->options([
                    'To Do' => 'To Do',
                    'In Progress' => 'In Progress',
                    'Done' => 'Done',
                ])
                ->default('To Do'),
            DatePicker::make('deadline')->afterOrEqual('today'),
        ];
    }

    public static function getTable(): array
    {
        return [
            TextColumn::make('title')->searchable()->sortable(),
            TextColumn::make('project.name')->label('Project'),
            ImageColumn::make('user.avatar_url')->label('Assigned To')->circular()->defaultImageUrl(url('https://placehold.co/150')),
            TextColumn::make('status')->badge()
                ->colors([
                    'To Do' => 'danger',
                    'In Progress' => 'warning',
                    'Done' => 'success',
                ]),
            TextColumn::make('deadline')->date(),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(self::getTable())
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
