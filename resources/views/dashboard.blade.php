<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="my-5  m-auto">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-dismissible fade show py-2 mb-1 bg-danger">
                            <div class="d-flex align-items-center">
                                <div class="fs-3 text-white"><ion-icon name="close-circle-sharp" role="img" class="md hydrated" aria-label="close circle sharp"></ion-icon>
                                </div>
                                <div class="ms-3">
                                    <div class="text-white">{{$error}}</div>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Button trigger modal -->
                <x-primary-button class="ml-3">
                    <x-slot name="attribute">
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                    </x-slot>
                    Create Category
                </x-primary-button>
                <!-- Modal -->

                <x-modal-bootstrap
                    action="{{route('categories.store')}}"
                    method="post"
                    methodInBody="post"
                    title="CreateCategory"
                    modelId="staticBackdrop">
                    <xslot name="inputs">

                        <x-localization>
                            <x-slot name="localizationData">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <div
                                        class="tab-pane fade {{LaravelLocalization::getCurrentLocale()  == $localeCode ? 'show active' :''}}"
                                        id="tab_{{$properties['name']}}_language" role="tabpanel">

                                        <div class="form-group">
                                            <label for="categoryName" class="block font-medium text-sm text-gray-700">Category
                                                Name In {{$properties['name']}}</label>
                                            <input type="text" id="categoryName" name="name[{{ $localeCode }}]"
                                                   class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                                        </div>
                                    </div>
                                @endforeach
                            </x-slot>
                        </x-localization>
                    </xslot>
                </x-modal-bootstrap>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Control</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td class="border px-4 py-2">{{$category->id}}</td>
                            <td class="border px-4 py-2">{{$category->name}}</td>
                            <td class="border px-4 py-2">
                                <x-primary-button class="ml-3">
                                    <x-slot name="attribute">
                                        data-bs-toggle="modal" data-bs-target="#edit_category_{{$category->id}}"
                                    </x-slot>
                                   Edit
                                </x-primary-button>
                                <!-- Modal -->

                                <x-modal-bootstrap
                                    action="{{route('categories.update', $category->id)}}"
                                    method="post"
                                    methodInBody="put"
                                    title="Edit Category"
                                    modelId="edit_category_{{$category->id}}">
                                    <xslot name="inputs">

                                        <x-localization prefix="edit" id="{{$category->id}}">
                                            <x-slot name="localizationData">
                                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                    <div
                                                        class="tab-pane fade {{LaravelLocalization::getCurrentLocale()  == $localeCode ? 'show active' :''}}"
                                                        id="edit_{{$properties['name']}}_{{$category->id}}" role="tabpanel">

                                                        <div class="form-group">
                                                            <label for="categoryName" class="block font-medium text-sm text-gray-700">Category
                                                                Name In {{$properties['name']}}</label>
                                                            <input type="text" id="categoryName" name="name[{{ $localeCode }}]"
                                                                   value="{{$category->getTranslation('name', $localeCode)}}"
                                                                   class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </x-slot>
                                        </x-localization>
                                    </xslot>
                                </x-modal-bootstrap>


                                <x-primary-button class="ml-3">
                                    <x-slot name="attribute">
                                        data-bs-toggle="modal" data-bs-target="#delete_category_{{$category->id}}"
                                    </x-slot>
                                    Delete
                                </x-primary-button>
                                <!-- Modal -->

                                <x-modal-bootstrap
                                    action="{{route('categories.destroy', $category->id)}}"
                                    method="post"
                                    methodInBody="delete"
                                    title="Delete Category"
                                    modelId="delete_category_{{$category->id}}">
                                    <xslot name="inputs">

                                        <x-localization prefix="delete" id="{{$category->id}}">
                                            <x-slot name="localizationData">
                                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                    <div
                                                        class="tab-pane fade {{LaravelLocalization::getCurrentLocale()  == $localeCode ? 'show active' :''}}"
                                                        id="delete_{{$properties['name']}}_{{$category->id}}" role="tabpanel">

                                                        <div class="form-group">
                                                            <label for="categoryName" class="block font-medium text-sm text-gray-700">Category
                                                                Name In {{$properties['name']}}</label>
                                                            <input type="text" id="categoryName" name="name[{{ $localeCode }}]"
                                                                   value="{{$category->getTranslation('name', $localeCode)}}"
                                                                   readonly
                                                                   class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </x-slot>
                                        </x-localization>
                                    </xslot>
                                </x-modal-bootstrap>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <!-- Button trigger modal -->
              <x-primary-button class="ml-3">
                  <x-slot name="attribute">
                      data-bs-toggle="modal" data-bs-target="#createProduct"
                  </x-slot>
                  Create Products
              </x-primary-button>
              <!-- Modal -->

              <x-modal-bootstrap
                  action="{{route('products.store')}}"
                  method="post"
                  methodInBody="post"
                  title="Create Product"
                  modelId="createProduct">
                  <xslot name="inputs">

                      <x-localization prefix="product">
                          <x-slot name="localizationData" >
                              @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                  <div
                                      class="tab-pane fade {{LaravelLocalization::getCurrentLocale()  == $localeCode ? 'show active' :''}}"
                                      id="product_{{$properties['name']}}_language" role="tabpanel">

                                      <div class="form-group">
                                          <label for="categoryName" class="block font-medium text-sm text-gray-700">Product
                                              Name In {{$properties['name']}}</label>
                                          <input type="text" id="" name="name[{{ $localeCode }}]"
                                                 class="form-input mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                                          <label for="description" class="block font-medium text-sm text-gray-700">Description
                                             Product Name In {{$properties['name']}}</label>
                                          <textarea id="" name="description[{{ $localeCode }}]" rows="4" class="form-textarea mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>

                                      </div>
                                  </div>
                              @endforeach
                              <label for="description" class="block font-medium text-sm text-gray-700">Select Category</label>

                                      <select id="category" name="category" class="block w-full pl-3 pr-10 py-2 text-base leading-6 rounded-md border-gray-300 shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                      <option value="">Select a category</option>
                                          @foreach($categories as $category)
                                              <option value="{{$category->id}}">{{$category->name}}</option>
                                          @endforeach
                                  </select>

                                  <div class="mb-4">
                                      <label for="image" class="block text-gray-700 font-bold mb-2">Choose an image</label>
                                      <input id="image" name="image" type="file" class="form-input py-2 px-3 leading-tight block w-full rounded-md border-gray-300 shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                  </div>
                          </x-slot>
                      </x-localization>
                  </xslot>
              </x-modal-bootstrap>


              <x-primary-button class="ml-3">
                  <x-slot name="attribute">
                      data-bs-toggle="modal" data-bs-target="#search"
                  </x-slot>
                  Filter Or Search
              </x-primary-button>
              <!-- Modal -->

              <x-modal-bootstrap
                  action="{{route('dashboard')}}"
                  methods="get"
                  methodInBody="get"
                  title="filter"
                  modelId="search">
                  <xslot name="inputs">
                          <label for="categoryName" class="block font-medium text-sm text-gray-700">Name</label>
                          <input type="text" id="" name="name"
                                 class="form-input mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>

                          <label for="description" class="block font-medium text-sm text-gray-700">Select Category</label>

                          <select id="category" name="category" class="block w-full pl-3 pr-10 py-2 text-base leading-6 rounded-md border-gray-300 shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                              <option value="">Select a category</option>
                              @foreach($categories as $category)
                                  <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                          </select>
                  </xslot>
              </x-modal-bootstrap>
              <table class="table">
                  <thead>
                  <tr>
                      <th class="px-4 py-2">ID</th>
                      <th class="px-4 py-2">Name</th>
                      <th class="px-4 py-2">Category</th>
                      <th class="px-4 py-2">Image</th>
                      <th class="px-4 py-2">Control</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($products as $product)
                      <tr>
                          <td class="border px-4 py-2">{{$product->id}}</td>
                          <td class="border px-4 py-2">{{$product->name}}</td>
                          <td class="border px-4 py-2">{{$product->categoryName}}</td>
                          <td class="border px-4 py-2">
                              <img src="{{URL::asset('files/products/' . $product->image)}}" alt="Thumbnail" class="w-16 h-16 object-cover rounded-lg">

                          </td>
                          <td class="border px-4 py-2">
                              <x-primary-button class="ml-3">
                                  <x-slot name="attribute">
                                      data-bs-toggle="modal" data-bs-target="#edit_product_{{$product->id}}"
                                  </x-slot>
                                  Edit
                              </x-primary-button>
                              <!-- Modal -->

                              <x-modal-bootstrap
                                  action="{{route('products.update', $product->id)}}"
                                  method="post"
                                  methodInBody="put"
                                  title="Edit Product"
                                  modelId="edit_product_{{$product->id}}">
                                  <xslot name="inputs">

                                      <x-localization prefix="edit_product" id="{{$product->id}}">
                                          <x-slot name="localizationData">
                                              @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                  <div
                                                      class="tab-pane fade {{LaravelLocalization::getCurrentLocale()  == $localeCode ? 'show active' :''}}"
                                                      id="edit_product_{{$properties['name']}}_{{$product->id}}" role="tabpanel">

                                                      <div class="form-group">
                                                          <label for="categoryName" class="block font-medium text-sm text-gray-700">Product
                                                              Name In {{$properties['name']}}</label>
                                                          <input type="text" id="categoryName" name="name[{{ $localeCode }}]"
                                                                 value="{{$product->getTranslation('name', $localeCode)}}"
                                                                 class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                                                      </div>
                                                      <label for="description" class="block font-medium text-sm text-gray-700">Description
                                                          Product Name In {{$properties['name']}}</label>
                                                      <textarea id=""
                                                                name="description[{{ $localeCode }}]"
                                                                rows="4" class="form-textarea mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{$product->getTranslation('description', $localeCode)}}</textarea>

                                                  </div>
                                              @endforeach

                                                  <label for="description" class="block font-medium text-sm text-gray-700">Select Category</label>

                                                  <select id="category" name="category" class="block w-full pl-3 pr-10 py-2 text-base leading-6 rounded-md border-gray-300 shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                      <option value="">Select a category</option>
                                                      @foreach($categories as $category)
                                                          <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                                                      @endforeach
                                                  </select>

                                                  <div class="mb-4">
                                                      <label for="image" class="block text-gray-700 font-bold mb-2">Choose an image</label>
                                                      <input id="image" name="image" type="file" class="form-input py-2 px-3 leading-tight block w-full rounded-md border-gray-300 shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                  </div>
                                          </x-slot>
                                      </x-localization>
                                  </xslot>
                              </x-modal-bootstrap>


                              <x-primary-button class="ml-3">
                                  <x-slot name="attribute">
                                      data-bs-toggle="modal" data-bs-target="#delete_product_{{$product->id}}"
                                  </x-slot>
                                  Delete
                              </x-primary-button>
                              <!-- Modal -->

                              <x-modal-bootstrap
                                  action="{{route('products.destroy', $product->id)}}"
                                  method="post"
                                  methodInBody="delete"
                                  title="Delete Category"
                                  modelId="delete_product_{{$product->id}}">
                                  <xslot name="inputs">

                                      <x-localization prefix="delete_product" id="{{$product->id}}">
                                          <x-slot name="localizationData">
                                              @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                  <div
                                                      class="tab-pane fade {{LaravelLocalization::getCurrentLocale()  == $localeCode ? 'show active' :''}}"
                                                      id="delete_product_{{$properties['name']}}_{{$product->id}}" role="tabpanel">

                                                      <div class="form-group">
                                                          <label for="" class="block font-medium text-sm text-gray-700">Product
                                                              Name In {{$localeCode}}</label>
                                                          <input type="text" id="" name="name[{{ $localeCode }}]"
                                                                 value="{{$product->getTranslation('name', $localeCode)}}"
                                                                 readonly
                                                                 class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                                                      </div>
                                                  </div>
                                              @endforeach
                                          </x-slot>
                                      </x-localization>
                                  </xslot>
                              </x-modal-bootstrap>
                          </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
          </div>
      </div>
    </div>


</x-app-layout>
