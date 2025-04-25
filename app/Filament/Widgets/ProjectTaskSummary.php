<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Project;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class ProjectTaskSummary extends BaseWidget
{
    protected static ?int $sort = -1;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Project::query()
                    ->withCount([
                        'tasks as todo_count' => fn($q) => $q->where('status', 'To Do'),
                        'tasks as in_progress_count' => fn($q) => $q->where('status', 'In Progress'),
                        'tasks as done_count' => fn($q) => $q->where('status', 'Done'),
                    ])
            )
            ->columns(
            [
                TextColumn::make('name')
                    ->label('Project')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('todo_count')
                    ->label('To Do')
                    ->numeric()
                    ->alignCenter(),

                TextColumn::make('in_progress_count')
                    ->label('In Progress')
                    ->numeric()
                    ->alignCenter(),

                TextColumn::make('done_count')
                    ->label('Done')
                    ->numeric()
                    ->alignCenter(),
            ]);
    }
}
