@props([

'localizationData' ,
'prefix' => 'tab',
'id' => "language",

])

<ul class="nav nav-tabs nav-danger" role="tablist">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <li class="nav-item" role="presentation">
            <a class="nav-link {{LaravelLocalization::getCurrentLocale()  == $localeCode ? 'active' :''}}" data-bs-toggle="tab" href="#{{$prefix .'_' . $properties['name']}}_{{$id}}" role="tab" aria-selected="true">
                <div class="d-flex align-items-center">
                    <div class="tab-icon">
                        <i class="fa-solid fa-house-flag mx-1"></i>
                    </div>
                    <div class="tab-title">{{$properties['native']}}</div>
                </div>
            </a>
        </li>
    @endforeach
</ul>

<div class="tab-content mt-2">
        {{$localizationData}}
</div>

