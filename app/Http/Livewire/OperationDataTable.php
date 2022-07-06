<?php

namespace App\Http\Livewire;

use App\Models\Operation;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class OperationDataTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped('#A6ACCD')
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),

            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return Builder<\App\Models\Operation>
    */
    public string $primaryKey = 'operations.id';
    public string $sortField = 'operations.id';
    public function datasource(): Builder
    {
        return Operation::query()
            ->join('categories', function ($categories) {
                $categories->on('operations.category', '=', 'categories.id');
            })
            ->join('clients', function ($clients) {
                $clients->on('operations.client', '=', 'clients.id');
            })
            ->join('payments', function ($payments) {
                $payments->on('operations.payment', '=', 'payments.id');
            })
            ->select([
                'operations.id',
                'operations.nature',
                'operations.date_operation',
                'operations.outcome',
                'operations.income',
                'categories.name as category',
                'clients.lastname as client',
                'payments.name as payment',
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [
            'payments' => [ // relationship on dishes model
                'name', // column enabled to search
            ],
            'clients' => [ // relationship on dishes model
                'lastname', // column enabled to search
            ],
            'categories' => [ // relationship on dishes model
                'name', // column enabled to search
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('nature')
            ->addColumn('date_operation_formatted', fn (Operation $model) => Carbon::parse($model->date_operation)->format('d/m/Y'))
            ->addColumn('outcome')
            ->addColumn('income')
            ->addColumn('category')
            ->addColumn('payment')
            ->addColumn('client')
            ->addColumn('actions');
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
/*            Column::make('ID', 'id')
                ->makeInputRange(),*/

            Column::make('NATURE', 'nature')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('DATE OPERATION', 'date_operation_formatted', 'date_operation')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('OUTCOME', 'outcome')
                ->sortable()
                ->searchable(),

            Column::make('INCOME', 'income')
                ->sortable()
                ->searchable(),

            Column::make('CATEGORY', 'category')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('PAYMENT', 'payment')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('CLIENT', 'client')
                ->sortable()
                ->searchable()
                ->makeInputText(),
        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Operation Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
       return [
/*           Button::make('show', 'Voir')
               ->class('btn btn-primary btn-sm')
               ->route('operations.show', ['operation' => 'id']),*/

           Button::make('edit', 'Editer')
               ->class('btn btn-primary btn-sm')
               ->route('operations.edit', ['operation' => 'id']),

           Button::make('destroy', 'Supprimer')
               ->class('btn btn-danger btn-sm')
               ->route('operations.destroy', ['operation' => 'id'])
               ->method('delete')
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Operation Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [
           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($operation) => $operation->id === 1)
                ->hide(),
        ];
    }
    */
}
