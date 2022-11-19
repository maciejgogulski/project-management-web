@if ($searchBy)
  @component('laravel-views::components.form.input-group', [
    'placeholder' => __('search.placeholder'),
    'model' => 'search',
    'onClick' => 'clearSearch',
    'icon' => $search ? 'x-circle' : 'search',
    ])
  @endcomponent
@endif
