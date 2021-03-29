<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        
        <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link home" href="{{ url('/') }}">{{ __('home') }}</a>
                </li>

            </ul>
            <!-- middle Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth
                <li class="nav-item">
                    
                    <a class="nav-link mid-link" href="{{ route('profile.get') }}">
                        <img class="rounded-circle" src="{{asset('images/users/'.Auth::user()->photo)}}"/>
                        {{ __('profile') }}
                    </a>
                </li>

                <li class="nav-item">
                    
                    <a class="nav-link mid-link" href="{{url('orders/show') }}">
                        
                        {{ __('orders') }}
                    </a>
                </li>
                @endauth
                

                <li class="nav-item">
                    <a class="nav-link mid-link" href="{{ route('item.get') }}">{{ __('items') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mid-link" href="{{ route('category.get') }}">{{ __('categories') }}</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0 search" id="search_submit" method="POST" action="{{url('items/get')}}">
                @csrf
                {{isset($search)?null:$search=null}}
                <input class="form-control mr-sm-2" type="search" value="{{old('search',$search)}}" id="search" name="search" placeholder="Search" >
                
                    <div class="card {{Auth::user()!=null ? 'search_auth' : 'search_guest'}} "   >
                        <ul class="list-group list-group-flush " >
                            
                        </ul>
                    </div>

                <button class="btn btn-outline-success my-2 my-sm-0 "  type="submit">Search</button>
            </form>
            

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    
                    <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ ucfirst(substr(Auth::user()->name,0,1)) }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    
                    <div id="black-bell"><i class="fas fa-bell fa-lg"  id="bell"  ><span style="color: red"  class="notifications_count" id="notification"></span></i></div>
                    
                @endguest
            </ul>
        </div>
        
    </div>
    <form id="form">
        @csrf
    </form>
    <div class="card notif " style="width: 26rem; display:none;" id="notif"  >
        <div class="card-header">
            <h3 class="header" >Notifications</h3>
        </div>
        <ul class="list-group list-group-flush com" >
            
        </ul>
    </div>

    
</nav>



@section('script_notify')
    @auth
        <script>
            //ajax vanilla js requests
            "use strict";
            
            //ajax get notifications
            function notify(){
                let agaxRequest=new XMLHttpRequest();
                
                agaxRequest.onreadystatechange=function(){
                    if(this.readyState == 4 && this.status == 200){
                        let res=JSON.parse(this.responseText);
                        let notifications_count= res.notifications_not_readed_count;
                        let notifs_count=document.getElementById('notification');

                        if(notifications_count != 0){
                            notifs_count.textContent = notifications_count;
                        }

                        let show_notif=document.getElementById('notif');
                        let bell=document.getElementById('bell');

                        bell.onclick=function(){
                            show_notif.style.display=''
                            
                            let comments=res.all_notifications;
                            let newHtml=[];

                            for (let i = 0; i < comments.length; i++) {
                                newHtml.push(
                                    '<a class="item_link" href="items/details/'+comments[i].item_id+'">'+
                                        '<li class="list-group-item comments">'+
                                            '<img class="rounded-circle user_image" src="/images/users/'+comments[i].users.photo+'"/>'
                                            +'<span class="user_name">'+comments[i].users.name+'</span>'+' commented on your item:' 
                                            +'<span class="comm">'
                                                +comments[i].comment 
                                            +'</span>'  + 
                                        '</li>'+
                                    '</a>'
                                )
                                
                            }
                            
                            let notifs=document.getElementsByClassName('com')[0]
                            notifs.innerHTML=newHtml.join("")
                        }
                                
                        document.onclick=function(){
                            if(window.event.srcElement.id != 'bell'){
                                show_notif.style.display = 'none';
                            }
                        }
                        
                    }

                    if(this.readyState == 4){
                        repeat_notifs();
                    }
                }
                
                agaxRequest.open('GET',"{{url('notifications/show')}}");
                agaxRequest.send();
            }


            //ajax update notifications
                function update_notifs(){
                    
                    let Request=new XMLHttpRequest();

                    Request.onreadystatechange=function(){
                        
                        if(this.readyState == 4 && this.status == 200){
                            let notifs_count=document.getElementById('notification');
                            notifs_count.textContent='';
                            
                        }
                    }

                    Request.open('POST',"{{url('notifications/update')}}");
                    Request.setRequestHeader('content-type','application/x-www-form-urlencoded')
                    Request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
                    Request.send();
                }

                

            window.onload=function(){
                notify()

                
                document.getElementById('black-bell').onclick=function(){
                    let notifs_count=document.getElementById('notification').textContent;
                    if(notifs_count > 0){
                        update_notifs()
                    }
                        
                }
                    
                
            }

            function repeat_notifs(){
                setTimeout(function(){notify()},3000)
            }
            







            //jquery ajax requests

            //ajax get notifications
            /*function notify(){
                
                $.ajax({
                    type   : "get",
                    url    : "{{url('notifications/show')}}",
                    success:function(data,status){
                        
                        if(status=='success'){
                            let unreaded_notifications_count= data.notifications_not_readed_count;
                            if(unreaded_notifications_count != 0){
                                $('#notification').text(unreaded_notifications_count);
                                
                            }
                            
                            let comments=data.all_notifications
                            
                            $('#bell').on('click',function(e){
                                $('.notif').show();
                                $('.no_notif').show();

                                e.stopPropagation();

                                let newHTML = [];
                                for (let i = 0; i < comments.length; i++) {
                                    
                                    newHTML.push(
                                        '<a class="item_link" href="items/details/'+comments[i].item_id+'">'+
                                            '<li class="list-group-item comments">'+
                                                '<img class="rounded-circle user_image" src="/images/users/'+comments[i].users.photo+'"/>'
                                                +'<span class="user_name">'+comments[i].users.name+'</span>'+' commented on your item:' 
                                                +'<span class="comm">'
                                                    +comments[i].comment 
                                                +'</span>'  + 
                                            '</li>'+
                                        '</a>'
                                    );
                                }
                                
                                $(".com").html(newHTML.join(""));
                                
                                let header=$('.header')
                                if( comments.length == 0 ){
                                    $('.notif').attr('class','card no_notif');
                                    header.text('no Notifications');
                                }else{
                                    $('.no_notif').attr('class','card notif');
                                    header.text('Notifications');
                                }
                            })

                            $(document).on('click',function(){
                                $('.notif').hide()
                                $('.no_notif').hide()
                            })
                        }
                    },
                    complete:function(){
                        update()
                    }
                });
            }
            function update(){
                setTimeout(function(){notify()},5000)
            }
            $(function(){
                
                notify()

                //ajax update notifications
                $('#bell').on('click',function(){
                    let notifications_count=$('.notifications_count').text()
                    
                    if(notifications_count > 0){
                            $.ajax({
                                type: "post",
                                url : "{{url('notifications/update')}}",
                                data: {
                                    "_token"     : "{{ csrf_token() }}",
                                    
                                },
                                success: function () {
                                    $('#notification').text('');
                                }
                            });
                    }
                })
                
            })
            */
        </script>
    @endauth


    <script>
        //ajax show search results 
        $(function(){
            $('#search').on('keyup',function(){
                let keyword=$(this).val()
                
                $.ajax({
                    type: "post",
                    url : "{{url('items/show/results')}}",
                    data: {
                        '_token':"{{csrf_token()}}",
                        'search':keyword
                    },
                    success: function (data,status) {
                        
                        if(status=='success'){
                            if(data.user_auth != null ){
                                var search_results=$('.search_auth');
                            }else{
                                var search_results=$('.search_guest');
                            }
                            
                            search_results.show()

                            let items_search=data.items
                            
                            if(items_search!=null){
                                let newHTML = [];
                                for (let i = 0; i < items_search.length; i++) {
                                    newHTML.push(
                                            '<li class="list-group-item products">'+
                                                items_search[i].name
                                            +'</li>'
                                    );
                                }
                                search_results.html(newHTML.join(""));

                                $('.products').on('click',function(){
                                    $('#search').val($(this).text())
                                    $('#search_submit').submit()
                                })

                                $(document).on('click',function(){
                                    search_results.hide()
                                })
                        }
                    }
                    }
                });
            })
        })
    </script>
@endsection




