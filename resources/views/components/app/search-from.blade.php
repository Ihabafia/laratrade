<!-- Open Search Section (visible on smaller screens) -->
<!-- Layout API, functionality initialized in Template._uiApiLayout() -->
<button type="button" class="btn btn-sm btn-alt-secondary d-md-none" data-toggle="layout"
        data-action="header_search_on">
    <i class="fa fa-fw fa-search"></i>
</button>
<!-- END Open Search Section -->

<!-- Search Form (visible on larger screens) -->
<form class="d-none d-md-inline-block" action="/dashboard" method="POST">
    @csrf
    <div class="input-group input-group-sm">
        <input type="text" class="form-control form-control-alt" placeholder="Search.."
               id="page-header-search-input2" name="page-header-search-input2">
        <span class="input-group-text border-0">
        <i class="fa fa-fw fa-search"></i>
      </span>
    </div>
</form>
<!-- END Search Form -->
