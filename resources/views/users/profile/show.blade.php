@extends('layouts.app')

@section('header')
<title>{{ env('APP_NAME', Auth::user()->name . ' - zikolaravelecommerce') }}</title>
<meta name="keywords" content="here you can see your profile details in zikolaravelecommerce" >
<link href="{{ asset('css/users/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    <button type="button" class="btn btn-info edit_photo" data-toggle="modal" data-target="#photoModal">
        edit photo
    </button>
    <button type="button" class="btn btn-info edit_profile" data-toggle="modal" data-target="#profileModal">
        edit profile
    </button>

    {{-- edit modal photo --}}
    <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">edit photo</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-success text-center" style="display: none" id="success_photo">

                    </div>
                    <div class="card text-white bg-dark mb-3" style="max-width: 24rem;">
                        <div class="card-header">Edit</div>
                        <div class="card-body">
                            <form method="POST" id="photoForm" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">photo</label>
                                    <input type="file" name="photo" class="form-control photo" aria-describedby="emailHelp">

                                    <small style="color: red" id="photo_err">

                                    </small>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="save_photo" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    {{-- edit modal profile --}}
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">edit profile</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-success text-center" id="success">

                    </div>
                    <div class="card text-white bg-dark mb-3" style="max-width: 24rem;">
                        <div class="card-header">Edit</div>
                        <div class="card-body">
                            <form>
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">name</label>
                                    <input type="text" name="name" value="{{ Auth::user()->name }}"
                                        class="form-control input" id="input_name" aria-describedby="emailHelp">

                                    <small style="color: red" id="name_err">
                                        
                                    </small>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">email</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                                        class="form-control input" id="input_email" >

                                    <small style="color: red" id="email_err">

                                    </small>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">password</label>
                                    <input type="password" name="password" class="form-control input"
                                        id="input_password" >

                                    <small style="color: red" id="password_err">

                                    </small>

                                </div>

                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-secondary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- delete modal item --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"  id="exampleModalLabel">warning</h3>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h5 style="color: red">Are you want to delete this item ?</h5>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                    <button type="submit" id="delete_item" itemId='' class="btn btn-danger" data-dismiss="modal">delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- edit modal item --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"  id="exampleModalLabel">edit item</h3>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-success text-center" id="update"></div>
                    <div class="card text-white bg-dark mb-3" style="max-width: 24rem;">
                        
                        <div class="card-body">
                            <form id="update_form">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">name</label>
                                    <input type="text" name="name" id="name"  class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    
                                        <small style="color: red" class="name_err">
                                            
                                        </small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">description</label>
                                    <input type="text" name="description" id="description"  class="form-control" id="exampleInputPassword1">
                                    
                                        <small style="color: red" class="description_err">
                                            
                                        </small>
                                    
                                </div>
                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">condition</label>
                                    <select name="condition"  id="condition" class="form-control">
                                        <option value=""> ... </option>
                                        <option value="new" id="new" > new </option>
                                        <option value="used" id="used" > used </option>
                                    </select>
                                    
                                        <small style="color: red" class="condition_err">
                                            
                                        </small>
                                    
                                </div>
                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">category</label>
                                    <select name="category_id" id="category"  class="form-control">
                                        <option value=""> ... </option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" class="category{{$category->id}}"> {{$category->name}} </option>
                                        @endforeach
                                        
                                        
                                    </select>
                                    
                                        <small style="color: red" class="category_id_err">
                                            
                                        </small>
                                    
                                </div>
                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">price</label>
                                    <input type="text" name="price" id="price"  class="form-control" id="exampleInputPassword1">
                                    
                                        <small style="color: red" class="price_err">
                                            
                                        </small>
                                    
                                </div>

                                <input type="text" name="id" id="id" style="display: none" class="form-control" id="exampleInputPassword1">
                                <input type="text" name="filename" id="filename" style="display: none" class="form-control" id="exampleInputPassword1">
                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">photo</label>
                                    <input type="file"  name="photo" id="photo" class="form-control" id="exampleInputPassword1">
                                    
                                    
                                        <small style="color: red" class="photo-err">
                                            
                                        </small>
                                    
                                </div>
                            </form>
                
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                    <button type="submit" id="update_item" itemID='' class="btn btn-danger" >save changes</button>
                </div>
            </div>
        </div>
    </div>


    {{-- ajax vanilla js requests --}}
@section('script')
    <script>
$(function(){let e=$("#success");e.hide();let t=$("#save");t.hide(),$(".input").on("change",function(){t.show()}),$("#save").on("click",function(t){t.preventDefault(),$("#name_err").text(""),$("#email_err").text(""),$("#password_err").text(""),$.ajax({method:"post",url:"{{ route('update.profile') }}",data:{_token:"{{ csrf_token() }}",name:$("input[name='name']").val(),email:$("input[name='email']").val(),password:$("input[name='password']").val(),photo_id:0},success:function(t,i){"success"==i&&(e.show(),e.text(t.success),$(".user_name").text($("#input_name").val()),$("#email").text($("input[name='email']").val()))},error:function(t){e.hide();let i=$.parseJSON(t.responseText);$.each(i.errors,function(e,t){$("#"+e+"_err").text(t[0])})},cache:!1})});let i=$("#save_photo");i.hide(),$(".photo").on("change",function(){i.show()});let r=$("#success_photo");r.hide(),$("#save_photo").on("click",function(e){e.preventDefault(),$("#photo_err").text("");let t=new FormData($("#photoForm")[0]);t.append("id",1),$.ajax({method:"post",url:"{{ url('profile/update/photo') }}",data:t,enctype:"multipart/form-data",processData:!1,contentType:!1,cache:!1,success:function(e,t){"success"==t&&(r.show(),r.text(e.success),$(".image-profile").attr("src","/images/users/"+e.photo))},error:function(e){r.hide();let t=$.parseJSON(e.responseText);$.each(t.errors,function(e,t){$("#"+e+"_err").text(t[0])})}})}),$(".delete").on("click",function(){let e=$(this).attr("item_id");$("#delete_item").attr("itemId",e)});let a=$(".deleteMsg");$("#delete_item").on("click",function(e){e.preventDefault();let t=$(this).attr("itemId");$.ajax({method:"delete",url:"{{url('items/item/delete')}}",data:{_token:"{{ csrf_token() }}",id:t},success:function(e,t){"success"==t&&(a.show(),a.text(e.success),$(".item"+e.item_id).remove())},error:function(e){let t=$("#delete_error");t.text(e.responseJSON.error),t.show()}})}),$(".edit").on("click",function(){let e=$(this).attr("items_id");$("edit_item").attr("itemID",e),$.ajax({method:"get",url:"{{url('items/edit/item')}}",data:{id:e},success:function(e,t){if("success"==t){$("#edit_item").attr("itemID",e.item.id),$("#name").attr("value",e.item.name),$("#description").attr("value",e.item.description),$("#category").attr("value",e.item.category_id),$("#price").attr("value",e.item.price),$("#id ").attr("value",e.item.id),$("#filename ").attr("value",e.item.photo);let t=e.item.condition;"new"==t&&$("#new").attr("selected","selected"),"used"==t&&$("#used").attr("selected","selected");let i=e.item.category_id;$(".category"+i).attr("selected","selected")}}})});let o=$("#update");o.hide(),$("#update_item").on("click",function(e){e.preventDefault(),$(".photo_err").text(""),$(".name_err").text(""),$(".description_err").text(""),$(".price_err").text(""),$(".condition_err").text(""),$(".category_id_err").text("");let t=new FormData($("#update_form")[0]);t.append("photo_id",1),$.ajax({method:"post",url:"{{ url('items/update') }}",data:t,enctype:"multipart/form-data",processData:!1,contentType:!1,cache:!1,success:function(e,t){"success"==t&&(o.show(),o.text("you updated item successfully"),$(".item_image").attr("src","/images/items/"+e.item.photo),$("#item_status").text(e.item.condition),$("#item_price").text(e.item.price),$("#item_name").text(e.item.name))},error:function(e){o.hide();let t=$.parseJSON(e.responseText);$.each(t.errors,function(e,t){$("."+e+"_err").text(t[0])})}})})});

    </script>
@endsection

{{-- profile details --}}

<div class="card mb-3" style="width: 36rem;">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="{{ asset('/images/users/' . Auth::user()->photo) }}" class="card-img image-profile" alt="..." />
        </div>
        <div class="col-md-8">
            <ul class="list-group">
                <li class="list-group-item active">
                    <h4>information</h4>
                </li>
                <li class="list-group-item items_list">
                    <span class="name_profile">name</span>:
                    <span id="name" class="user_name">{{ Auth::user()->name }}</span>
                </li>

                <li class="list-group-item items_list ">
                    <span class="email">email</span>:
                    <span id="email" class="user_email">{{ Auth::user()->email }}</span>
                </li>

                <li class="list-group-item items_list">
                    <span class="created_at"> created at</span>:
                    {{ Auth::user()->created_at }}
                </li>
            </ul>
        </div>
    </div>
</div>


{{-- user items --}}
<div class="alert alert-success deleteMsg text-center" style="display: none"></div>
<div class="alert alert-danger text-center" style="display: none" id="delete_error"> </div>
<div class="row">
    
    @foreach ($user_items as $item)
    
            <div class="col-sm-4 item{{$item->id}}">
                {{--<a class="btn btn-danger delete"  item_id="{{$item->id}}">delete</a>--}}
                <button type="button" class="btn btn-danger delete" item_id="{{$item->id}}" data-toggle="modal" data-target="#deleteModal">
                    delete
                </button>
                <button type="button" class="btn btn-info edit" items_id="{{$item->id}}" data-toggle="modal" data-target="#editModal">
                    edit
                </button>

                <div class="card" style="width: 14rem;">
                    <img src="{{ asset('images/items/' . $item->photo) }}" class="card-img-top item_image" alt="...">
                    <div class="card-body">
                        <h3 class="card-title" id="item_name">{{ $item->name }}</h3>
                        <ul class="list-group">
                            <li class="list-group-item"><span class="status">status</span >: <span id="item_status">{{ $item->condition }}</span></li>
                            <li class="list-group-item"><span class="price">price</span >:<span id="item_price">{{ $item->price }}</span> </li>
                            <li class="list-group-item"><span class="date">date</span>:{{ $item->date }} </li>
                        </ul>
                        <a class="btn btn-success" href="{{url('items/details/'.$item->id)}}">details</a>
                    </div>
                    
                </div>
            </div>
        
    @endforeach
</div>

@endsection
