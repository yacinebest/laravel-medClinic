<a href="{{ isset($route_show) ? route($route_show,$entity->id) : 'javascript:void(0)'}}">
    {{ $entity->last_name . ' ' . $entity->first_name  }}
</a>
