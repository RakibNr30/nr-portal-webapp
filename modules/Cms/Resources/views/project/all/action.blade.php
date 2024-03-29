@php
$user = \Modules\Ums\Entities\User::find(auth()->user()->id);
@endphp

<div class="btn-group">
    @if($data->status == 0)
        <a href="{{ route('backend.cms.project-pending.show', [$data->id]) }}" type="button" class="btn btn-default">
            <i class="fas fa-eye"></i>
        </a>
    @endif
    @if($data->status == 1)
        <a href="{{ route('backend.cms.project-approved.show', [$data->id]) }}" type="button" class="btn btn-default">
            <i class="fas fa-eye"></i>
        </a>
    @endif
    @if($data->status == 2)
        <a href="{{ route('backend.cms.project-accepted.show', [$data->id]) }}" type="button" class="btn btn-default">
            <i class="fas fa-eye"></i>
        </a>
    @endif
    {{--<a href="{{ route('backend.cms.project-approved.edit', [$data->id]) }}" type="button" class="btn btn-default">
        <i class="fas fa-pen"></i>
    </a>--}}
    @if(!$user->hasRole('company'))
        <a type="button" class="btn btn-default btn-delete" tabindex="0" data-html="true" data-popover-content="#confirm_delete{{ $data->id }}">
            <i class="fas fa-trash"></i>
        </a>
        <div style="display: none;" id="confirm_delete{{ $data->id }}">
            <div class="popover-body">
                <a type="button" class="btn btn-danger text-white delete_submit {{ $data->id }}">Delete</a>
                <a role="button" class="btn btn-dark text-white">Cancel</a>
            </div>
        </div>
        @if($data->status == 0)
            {!! Form::open(['url' => route('backend.cms.project-pending.destroy', [$data->id]), 'method' => 'delete', 'id' => 'delete_form' . $data->id]) !!}{!! Form::close() !!}
        @endif
        @if($data->status == 1)
            {!! Form::open(['url' => route('backend.cms.project-approved.destroy', [$data->id]), 'method' => 'delete', 'id' => 'delete_form' . $data->id]) !!}{!! Form::close() !!}
        @endif
        @if($data->status == 2)
            {!! Form::open(['url' => route('backend.cms.project-accepted.destroy', [$data->id]), 'method' => 'delete', 'id' => 'delete_form' . $data->id]) !!}{!! Form::close() !!}
        @endif
    @endif
</div>
