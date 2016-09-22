
<h1>Express</h1>

<p>Welcome to Express</p>

<div id="example"></div>
<!--.row--><!--  form(method='GET', action='/search', class='col s12')--><!--    .row-->
<!--      .input-field.col.s10--><!--        i.material-icons.prefix search-->
<!--        input(type='text', name='q', id='query_search')-->
<!--        label(for='query_search') Enter the name of an artist or song--><!--      .input-field.col.s2-->
<!--        button(type='submit', class='waves-effect waves-light btn') Search-->
<div class="row">
	<form method="GET" action="/yamusic" class="col s12">
		<div class="row">
			<div class="input-field col s10">
				<i class="material-icons prefix">search</i>
				<input type="text" name="q" id="q_search">
				<label for="q_search">Enter the name of song</label>
			</div>
			<div class="input-field col s2">
				<button type="submit" class="waves-effect waves-light btn">Search</button>
			</div>
		</div>
	</form>
</div>