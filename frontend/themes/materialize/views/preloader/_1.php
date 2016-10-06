<div class="cssload-container">
	<div class="cssload-whirlpool"></div>
</div>

<style>

	.cssload-container{
		position:relative;
	}

	.cssload-whirlpool,
	.cssload-whirlpool::before,
	.cssload-whirlpool::after {
		position: absolute;
		top: 50%;
		left: 50%;
		border: 3px solid rgb(236, 239, 241);
		border-radius: 1374px;
		-o-border-radius: 1374px;
		-ms-border-radius: 1374px;
		-webkit-border-radius: 1374px;
		-moz-border-radius: 1374px;
	}

	.cssload-whirlpool {
		border-left-color: #2196f3;
	}

	.cssload-whirlpool::before {
		border-left-color: #ff5722;
	}

	.cssload-whirlpool::after {
		border-left-color: #4caf50;
	}

	.cssload-whirlpool {
		margin: -34px 0 0 -34px;
		height: 73px;
		width: 73px;
		animation: cssload-rotate 1750ms linear infinite;
		-o-animation: cssload-rotate 1750ms linear infinite;
		-ms-animation: cssload-rotate 1750ms linear infinite;
		-webkit-animation: cssload-rotate 1750ms linear infinite;
		-moz-animation: cssload-rotate 1750ms linear infinite;
	}

	.cssload-whirlpool::before {
		content: "";
		margin: -29px 0 0 -30px;
		height: 58px;
		width: 58px;
		animation: cssload-rotate 1750ms linear infinite;
		-o-animation: cssload-rotate 1750ms linear infinite;
		-ms-animation: cssload-rotate 1750ms linear infinite;
		-webkit-animation: cssload-rotate 1750ms linear infinite;
		-moz-animation: cssload-rotate 1750ms linear infinite;
	}

	.cssload-whirlpool::after {
		content: "";
		margin: -46px 0 0 -44px;
		height: 91px;
		width: 91px;
		animation: cssload-rotate 3500ms linear infinite;
		-o-animation: cssload-rotate 3500ms linear infinite;
		-ms-animation: cssload-rotate 3500ms linear infinite;
		-webkit-animation: cssload-rotate 3500ms linear infinite;
		-moz-animation: cssload-rotate 3500ms linear infinite;
	}

	@keyframes cssload-rotate {
		100% {
			transform: rotate(360deg);
		}
	}

	@-o-keyframes cssload-rotate {
		100% {
			-o-transform: rotate(360deg);
		}
	}

	@-ms-keyframes cssload-rotate {
		100% {
			-ms-transform: rotate(360deg);
		}
	}

	@-webkit-keyframes cssload-rotate {
		100% {
			-webkit-transform: rotate(360deg);
		}
	}

	@-moz-keyframes cssload-rotate {
		100% {
			-moz-transform: rotate(360deg);
		}
	}
</style>

<script type="text/javascript">

</script>