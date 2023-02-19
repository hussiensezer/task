@props([
'modelId' ,
'formId' => '',
'methods' => 'post' ,
'methodInBody' => 'post' ,
'enctype' => 'multipart/form-data',
'action' ,
'title',
'size' => '',
'modelClass' => '',
'formClass' => '',
])
<!--/Start: Modal -->
<form method="{{$methods}}" action="{{$action}}" id="{{$formId}}" enctype="{{$enctype}}" class="{{$formClass}}" >
    <div class="modal fade" id="{{$modelId}}"  aria-hidden="true" >
        <div class="modal-dialog modal-dialog-scrollable {{$size}}">
            <div class="modal-content {{$modelClass}}">
                <div class="modal-header">
                    <h5 class="modal-title">{{$title}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>


                <div class="languages-tabs-wrapper modal-body">
                    @if($methods != 'get')
                        @csrf
                    @endif
                    @method($methodInBody)
                   {{$slot}}

                </div>
                <div class="modal-footer">
                    <x-primary-button class="ml-3" type="submit">
                        Save
                        <x-slot name="attribute">

                        </x-slot>
                    </x-primary-button>
                    <x-secondary-button>
                        Close
                        <x-slot name="attribute">
                            data-bs-dismiss="modal"
                        </x-slot>
                    </x-secondary-button>
                </div>

            </div>

        </div>
    </div>
    <!--/End: Model-->
</form>
