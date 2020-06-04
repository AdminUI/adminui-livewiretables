<div class="aui-lwtable">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Search</label>
                <input type="text"
                    wire:model.debounce.500ms="search"
                    placeholder="Enter Search Query"
                    class="form-control"
                />
            </div>
        </div>
        <div class="col-md-3">
            @if (config('livewire-table.status', true))
                <div class="form-group">
                    <label for="zero">Active Orders</label>
                    <div class="onoffswitch mt-1">
                        <input type="checkbox"
                            wire:model="showActive"
                            class="onoffswitch-checkbox"
                            id="switchzero"
                            value="1"
                            checked=""
                        >
                        <label class="onoffswitch-label" for="switchzero">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <x-loading />
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    @foreach ($columns as $column)
                                        <x-tables.table-header
                                            :column="$column"
                                            :sortAsc="$sortAsc"
                                            :sortField="$sortField"
                                        />
                                    @endforeach
                                    <th style="width: 100px;"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($rows as $row)
                                    <x-tables.table-row
                                        :columns="$columns"
                                        :row="$row"
                                        :actions="$actions"
                                    />
                                @endforeach
                            </tbody>
                        </table>
                        <x-tables.table-footer :items="$rows" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
