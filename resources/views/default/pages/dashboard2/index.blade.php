@if(auth()->user()->role->name == 'vet')
<script>
	routes.executeRoute('vet_serviceQueue', {
		url: 'vet_serviceQueue'
	});
</script>
@elseif(auth()->user()->role->name == 'client')
<script>
	routes.executeRoute('client_application', {
		url: 'client_application'
	});
</script>
@else
{{--@include('default.pages.dashboard2.includes.head')--}}
{{--@include('default.pages.dashboard2.includes.body')--}}
	@include('default.fgp.dashboard.index')
@endif