<!-- top -->
<a id="top-button" class="btn btn-primary text-white"><i class="fa fa-arrow-up"></i></a>
<style type="text/css">
#top-button{display: inline-block; text-align: center; border-radius: .5em; position: fixed; bottom: 6em; right: 1em; transition: all var(--transition); opacity: 0; visibility: hidden; z-index: 1000;}
#top-button:hover{opacity: 1!important; cursor: pointer}
#top-button:active{opacity: 1;}
#top-button.show{opacity: .5; visibility: visible; animation: bottomTop var(--transition)}
</style>
<!-- fab -->
<div class="position-fixed d-flex align-items-center justify-content-end text-right" style="bottom: 0; right: 0; z-index: 1;">
	<div class="bg-white shadow-sm px-3 py-2 mr-2" style="width: fit-content; animation: fab 2s infinite ease; border-radius: 1.5em">
		<span class="fw-bold">Contact Us</span>
	</div>
	<a class="fab" href="https://wa.me/{{setting('site.whatsapp')}}" target="blank">
	<div class="rounded-circle shadow-sm float-end text-center d-flex align-items-center justify-content-center mr-2 mb-2" style="width: 50px; height: 50px; background-color: var(--green)">
		<i class="fa fa-whatsapp fa-2x text-white"></i>
	</div>
	</a>
</div>
<!-- Footer -->
<footer class="footer text-center">
Copyright &copy; {{ date('Y') }}. All Rights Reserved by <a href="{{ URL::to('/') }}" target="_blank">{{ setting('site.name') }}</a>.
</footer>
<!-- /Footer -->