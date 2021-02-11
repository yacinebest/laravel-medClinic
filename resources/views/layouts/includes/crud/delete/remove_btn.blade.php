{{--
    $id
    $name_id

    $simple_btn_remove not required
--}}

@if(isset($simple_btn_remove) && $simple_btn_remove)
<a data-entityid="{{ $id }}" data-entityname="{{ $name_id }}" class="btn bt-danger remove a-delete-entity">
    <i class="fas fa-minus" style="color: white;"></i>
</a>
@else
<a data-entityid="{{ $id }}" data-entityname="{{ $name_id }}" class="a-delete-entity">
    <i class="mdi mdi-delete mr-1"></i>
    Supprimer
</a>
@endif
