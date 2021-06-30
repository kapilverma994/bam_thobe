@extends('admin.master')
@section('content')
<div class="basic-form-area mg-b-15">
  <div class="container-fluid sparkline13-list">
<div class="page-header">
      <h2 class="main-content-title">Send Notification</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Send Notification</li>
      </ol>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <center>
                <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>
            </center> --}}
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('send.notification') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label>Body</label>
                            <textarea class="form-control" name="body"></textarea>
                          </div>
                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
    apiKey: "AIzaSyBPZwuPf0eb0_Q_WMJ5NTNjunSZkflZTdQ",
    authDomain: "laravel-562e7.firebaseapp.com",
    projectId: "laravel-562e7",
    storageBucket: "laravel-562e7.appspot.com",
    messagingSenderId: "543164534512",
    appId: "1:543164534512:web:002429424271a8bf1e7c35",
    measurementId: "G-95GKXVZJLP"
  };
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
//firebase.analytics();
const messaging = firebase.messaging();
	messaging
.requestPermission()
.then(function () {
//MsgElem.innerHTML = "Notification permission granted."
	console.log("Notification permission granted.");

     // get the token in the form of promise
	return messaging.getToken()
})
.then(function(token) {
 // print the token on the HTML page
  console.log(token);



})
.catch(function (err) {
	console.log("Unable to get permission to notify.", err);
});

messaging.onMessage(function(payload) {
    console.log(payload);
    var notify;
    notify = new Notification(payload.notification.title,{
        body: payload.notification.body,
        icon: payload.notification.icon,
        tag: "Dummy"
    });
    console.log(payload.notification);
});

    //firebase.initializeApp(config);
var database = firebase.database().ref().child("/users/");

database.on('value', function(snapshot) {
    renderUI(snapshot.val());
});

// On child added to db
database.on('child_added', function(data) {
	console.log("Comming");
    if(Notification.permission!=='default'){
        var notify;

        notify= new Notification('CodeWife - '+data.val().username,{
            'body': data.val().message,
            'icon': 'bell.png',
            'tag': data.getKey()
        });
        notify.onclick = function(){
            alert(this.tag);
        }
    }else{
        alert('Please allow the notification first');
    }
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();
});


</script>
@endsection
