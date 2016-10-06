<div class="wrapper">
	<div class="cssload-loader"></div>
</div>

<script>
	.wrapper {
		padding-left: 1em;
		padding-right: 1em;
		margin: auto;
		display: block;
		width: 195px;
	}

	.cssload-loader {
		width: 49px;
		height: 49px;
		border-radius: 50%;
		margin: 3em;
		display: inline-block;
		position: relative;
		vertical-align: middle;
	}

	.cssload-loader {
		width: 49px;
		height: 49px;
		border-radius: 50%;
		margin: 3em;
		display: inline-block;
		position: relative;
		vertical-align: middle;
	}
	.cssload-loader,
	.cssload-loader:before,
	.cssload-loader:after {
		animation: 0.85s infinite ease-in-out;
		-o-animation: 0.85s infinite ease-in-out;
		-ms-animation: 0.85s infinite ease-in-out;
		-webkit-animation: 0.85s infinite ease-in-out;
		-moz-animation: 0.85s infinite ease-in-out;
	}
	.cssload-loader:before,
	.cssload-loader:after {
		width: 100%;
		height: 100%;
		border-radius: 50%;
		position: absolute;
		top: 0;
		left: 0;
	}

	.cssload-loader:before,
	.cssload-loader:after {
		content: "";
	}

	.cssload-loader:before,
	.cssload-loader:after {
		content: "";
		background-color: rgb(51,51,51);
		transform: scale(0);
		-o-transform: scale(0);
		-ms-transform: scale(0);
		-webkit-transform: scale(0);
		-moz-transform: scale(0);
		animation: cssload-animation 1.275s infinite ease-in-out;
		-o-animation: cssload-animation 1.275s infinite ease-in-out;
		-ms-animation: cssload-animation 1.275s infinite ease-in-out;
		-webkit-animation: cssload-animation 1.275s infinite ease-in-out;
		-moz-animation: cssload-animation 1.275s infinite ease-in-out;
	}
	.cssload-loader:after { animation-delay: 0.6375s;
		-o-animation-delay: 0.6375s;
		-ms-animation-delay: 0.6375s;
		-webkit-animation-delay: 0.6375s;
		-moz-animation-delay: 0.6375s; }



	@keyframes cssload-animation {
		0%	 { transform: translateX(-100%) scale(0); }
	50%	{ transform: translateX(0%)		scale(1); }
	100% { transform: translateX(100%)	scale(0); }
	}

	@-o-keyframes cssload-animation {
		0%	 { -o-transform: translateX(-100%) scale(0); }
	50%	{ -o-transform: translateX(0%)		scale(1); }
	100% { -o-transform: translateX(100%)	scale(0); }
	}

	@-ms-keyframes cssload-animation {
		0%	 { -ms-transform: translateX(-100%) scale(0); }
	50%	{ -ms-transform: translateX(0%)		scale(1); }
	100% { -ms-transform: translateX(100%)	scale(0); }
	}

	@-webkit-keyframes cssload-animation {
		0%	 { -webkit-transform: translateX(-100%) scale(0); }
	50%	{ -webkit-transform: translateX(0%)		scale(1); }
	100% { -webkit-transform: translateX(100%)	scale(0); }
	}

	@-moz-keyframes cssload-animation {
		0%	 { -moz-transform: translateX(-100%) scale(0); }
	50%	{ -moz-transform: translateX(0%)		scale(1); }
	100% { -moz-transform: translateX(100%)	scale(0); }
	}
</script>