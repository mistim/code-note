<div class="cssload-container">
	<ul class="cssload-flex-container">
		<li>
			<span class="cssload-loading cssload-one"></span>
			<span class="cssload-loading cssload-two"></span>
			<span class="cssload-loading-center"></span>
		</li>
	</ul>
</div>

<style>
	.cssload-container * {
		box-sizing: border-box;
		-o-box-sizing: border-box;
		-ms-box-sizing: border-box;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
	}
	.cssload-container {
		margin: 23px auto 0 auto;
		max-width: 629px;
	}

	.cssload-container ul li{
		list-style: none;
	}

	.cssload-flex-container {
		display: flex;
		display: -o-flex;
		display: -ms-flex;
		display: -webkit-flex;
		display: -moz-flex;
		flex-direction: row;
		-o-flex-direction: row;
		-ms-flex-direction: row;
		-webkit-flex-direction: row;
		-moz-flex-direction: row;
		flex-wrap: wrap;
		-o-flex-wrap: wrap;
		-ms-flex-wrap: wrap;
		-webkit-flex-wrap: wrap;
		-moz-flex-wrap: wrap;
		justify-content: space-around;
	}
	.cssload-flex-container li {
		padding: 11px;
		height: 113px;
		width: 113px;
		margin: 34px 23px;
		position: relative;
		text-align: center;
	}

	.cssload-loading-center {
		display: inline-block;
		position: absolute;
		background: rgb(0,0,0);
		height: 34px;
		width: 34px;
		left: 41px;
		top: 42px;
		transform: rotate(45deg);
		-o-transform: rotate(45deg);
		-ms-transform: rotate(45deg);
		-webkit-transform: rotate(45deg);
		-moz-transform: rotate(45deg);
		border-radius: 3px;
		-o-border-radius: 3px;
		-ms-border-radius: 3px;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		animation: pulse 0.95s ease infinite;
		-o-animation: pulse 0.95s ease infinite;
		-ms-animation: pulse 0.95s ease infinite;
		-webkit-animation: pulse 0.95s ease infinite;
		-moz-animation: pulse 0.95s ease infinite;
	}

	.cssload-loading {
		display: inline-block;
		position: relative;
		width: 84px;
		height: 84px;
		margin-top: 3px;
		transform: rotate(45deg);
		-o-transform: rotate(45deg);
		-ms-transform: rotate(45deg);
		-webkit-transform: rotate(45deg);
		-moz-transform: rotate(45deg);
	}
	.cssload-loading:after, .cssload-loading:before {
		position: absolute;
		content: '';
		height: 11px;
		width: 11px;
		display: block;
		top: 0;
		background: rgb(0,0,0);
		border-radius: 3px;
		-o-border-radius: 3px;
		-ms-border-radius: 3px;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		animation-delay: -.4.75s;
		-o-animation-delay: -.4.75s;
		-ms-animation-delay: -.4.75s;
		-webkit-animation-delay: -.4.75s;
		-moz-animation-delay: -.4.75s;
	}
	.cssload-loading:after {
		right: 0;
		animation: square-tr 1.9s ease infinite;
		-o-animation: square-tr 1.9s ease infinite;
		-ms-animation: square-tr 1.9s ease infinite;
		-webkit-animation: square-tr 1.9s ease infinite;
		-moz-animation: square-tr 1.9s ease infinite;
		animation-delay: .118.75s;
		-o-animation-delay: .118.75s;
		-ms-animation-delay: .118.75s;
		-webkit-animation-delay: .118.75s;
		-moz-animation-delay: .118.75s;
	}
	.cssload-loading:before {
		animation: square-tl 1.9s ease infinite;
		-o-animation: square-tl 1.9s ease infinite;
		-ms-animation: square-tl 1.9s ease infinite;
		-webkit-animation: square-tl 1.9s ease infinite;
		-moz-animation: square-tl 1.9s ease infinite;
		animation-delay: .118.75s;
		-o-animation-delay: .118.75s;
		-ms-animation-delay: .118.75s;
		-webkit-animation-delay: .118.75s;
		-moz-animation-delay: .118.75s;
	}

	.cssload-loading.cssload-two {
		position: relative;
		top: -90px;
	}
	.cssload-loading.cssload-two:after, .cssload-loading.cssload-two:before {
		bottom: 0;
		top: initial;
	}
	.cssload-loading.cssload-two:after {
		animation: square-br 1.9s ease infinite;
		-o-animation: square-br 1.9s ease infinite;
		-ms-animation: square-br 1.9s ease infinite;
		-webkit-animation: square-br 1.9s ease infinite;
		-moz-animation: square-br 1.9s ease infinite;
		animation-direction: reverse;
		-o-animation-direction: reverse;
		-ms-animation-direction: reverse;
		-webkit-animation-direction: reverse;
		-moz-animation-direction: reverse;
	}
	.cssload-loading.cssload-two:before {
		animation: square-bl 1.9s ease infinite;
		-o-animation: square-bl 1.9s ease infinite;
		-ms-animation: square-bl 1.9s ease infinite;
		-webkit-animation: square-bl 1.9s ease infinite;
		-moz-animation: square-bl 1.9s ease infinite;
		animation-direction: reverse;
		-o-animation-direction: reverse;
		-ms-animation-direction: reverse;
		-webkit-animation-direction: reverse;
		-moz-animation-direction: reverse;
	}








	@keyframes square-tl {
		0% {
			transform: translate(0, 0);
		}
		25% {
			transform: translate(0, 70.5px);
		}
		50% {
			transform: translate(70.5px, 70.5px);
		}
		75% {
			transform: translate(70.5px, 0);
		}
	}

	@-o-keyframes square-tl {
		0% {
			-o-transform: translate(0, 0);
		}
		25% {
			-o-transform: translate(0, 70.5px);
		}
		50% {
			-o-transform: translate(70.5px, 70.5px);
		}
		75% {
			-o-transform: translate(70.5px, 0);
		}
	}

	@-ms-keyframes square-tl {
		0% {
			-ms-transform: translate(0, 0);
		}
		25% {
			-ms-transform: translate(0, 70.5px);
		}
		50% {
			-ms-transform: translate(70.5px, 70.5px);
		}
		75% {
			-ms-transform: translate(70.5px, 0);
		}
	}

	@-webkit-keyframes square-tl {
		0% {
			-webkit-transform: translate(0, 0);
		}
		25% {
			-webkit-transform: translate(0, 70.5px);
		}
		50% {
			-webkit-transform: translate(70.5px, 70.5px);
		}
		75% {
			-webkit-transform: translate(70.5px, 0);
		}
	}

	@-moz-keyframes square-tl {
		0% {
			-moz-transform: translate(0, 0);
		}
		25% {
			-moz-transform: translate(0, 70.5px);
		}
		50% {
			-moz-transform: translate(70.5px, 70.5px);
		}
		75% {
			-moz-transform: translate(70.5px, 0);
		}
	}

	@keyframes square-bl {
		0% {
			transform: translate(0, 0);
		}
		25% {
			transform: translate(0, -70.5px);
		}
		50% {
			transform: translate(70.5px, -70.5px);
		}
		75% {
			transform: translate(70.5px, 0);
		}
	}

	@-o-keyframes square-bl {
		0% {
			-o-transform: translate(0, 0);
		}
		25% {
			-o-transform: translate(0, -70.5px);
		}
		50% {
			-o-transform: translate(70.5px, -70.5px);
		}
		75% {
			-o-transform: translate(70.5px, 0);
		}
	}

	@-ms-keyframes square-bl {
		0% {
			-ms-transform: translate(0, 0);
		}
		25% {
			-ms-transform: translate(0, -70.5px);
		}
		50% {
			-ms-transform: translate(70.5px, -70.5px);
		}
		75% {
			-ms-transform: translate(70.5px, 0);
		}
	}

	@-webkit-keyframes square-bl {
		0% {
			-webkit-transform: translate(0, 0);
		}
		25% {
			-webkit-transform: translate(0, -70.5px);
		}
		50% {
			-webkit-transform: translate(70.5px, -70.5px);
		}
		75% {
			-webkit-transform: translate(70.5px, 0);
		}
	}

	@-moz-keyframes square-bl {
		0% {
			-moz-transform: translate(0, 0);
		}
		25% {
			-moz-transform: translate(0, -70.5px);
		}
		50% {
			-moz-transform: translate(70.5px, -70.5px);
		}
		75% {
			-moz-transform: translate(70.5px, 0);
		}
	}

	@keyframes square-tr {
		0% {
			transform: translate(0, 0);
		}
		25% {
			transform: translate(-70.5px, 0);
		}
		50% {
			transform: translate(-70.5px, 70.5px);
		}
		75% {
			transform: translate(0, 70.5px);
		}
	}

	@-o-keyframes square-tr {
		0% {
			-o-transform: translate(0, 0);
		}
		25% {
			-o-transform: translate(-70.5px, 0);
		}
		50% {
			-o-transform: translate(-70.5px, 70.5px);
		}
		75% {
			-o-transform: translate(0, 70.5px);
		}
	}

	@-ms-keyframes square-tr {
		0% {
			-ms-transform: translate(0, 0);
		}
		25% {
			-ms-transform: translate(-70.5px, 0);
		}
		50% {
			-ms-transform: translate(-70.5px, 70.5px);
		}
		75% {
			-ms-transform: translate(0, 70.5px);
		}
	}

	@-webkit-keyframes square-tr {
		0% {
			-webkit-transform: translate(0, 0);
		}
		25% {
			-webkit-transform: translate(-70.5px, 0);
		}
		50% {
			-webkit-transform: translate(-70.5px, 70.5px);
		}
		75% {
			-webkit-transform: translate(0, 70.5px);
		}
	}

	@-moz-keyframes square-tr {
		0% {
			-moz-transform: translate(0, 0);
		}
		25% {
			-moz-transform: translate(-70.5px, 0);
		}
		50% {
			-moz-transform: translate(-70.5px, 70.5px);
		}
		75% {
			-moz-transform: translate(0, 70.5px);
		}
	}

	@keyframes square-br {
		0% {
			transform: translate(0, 0);
		}
		25% {
			transform: translate(-70.5px, 0);
		}
		50% {
			transform: translate(-70.5px, -70.5px);
		}
		75% {
			transform: translate(0, -70.5px);
		}
	}

	@-o-keyframes square-br {
		0% {
			-o-transform: translate(0, 0);
		}
		25% {
			-o-transform: translate(-70.5px, 0);
		}
		50% {
			-o-transform: translate(-70.5px, -70.5px);
		}
		75% {
			-o-transform: translate(0, -70.5px);
		}
	}

	@-ms-keyframes square-br {
		0% {
			-ms-transform: translate(0, 0);
		}
		25% {
			-ms-transform: translate(-70.5px, 0);
		}
		50% {
			-ms-transform: translate(-70.5px, -70.5px);
		}
		75% {
			-ms-transform: translate(0, -70.5px);
		}
	}

	@-webkit-keyframes square-br {
		0% {
			-webkit-transform: translate(0, 0);
		}
		25% {
			-webkit-transform: translate(-70.5px, 0);
		}
		50% {
			-webkit-transform: translate(-70.5px, -70.5px);
		}
		75% {
			-webkit-transform: translate(0, -70.5px);
		}
	}

	@-moz-keyframes square-br {
		0% {
			-moz-transform: translate(0, 0);
		}
		25% {
			-moz-transform: translate(-70.5px, 0);
		}
		50% {
			-moz-transform: translate(-70.5px, -70.5px);
		}
		75% {
			-moz-transform: translate(0, -70.5px);
		}
	}

	@keyframes rotate {
		from {
			transform: rotate(0deg);
		}
		to {
			transform: rotate(360deg);
		}
	}

	@-o-keyframes rotate {
		from {
			-o-transform: rotate(0deg);
		}
		to {
			-o-transform: rotate(360deg);
		}
	}

	@-ms-keyframes rotate {
		from {
			-ms-transform: rotate(0deg);
		}
		to {
			-ms-transform: rotate(360deg);
		}
	}

	@-webkit-keyframes rotate {
		from {
			-webkit-transform: rotate(0deg);
		}
		to {
			-webkit-transform: rotate(360deg);
		}
	}

	@-moz-keyframes rotate {
		from {
			-moz-transform: rotate(0deg);
		}
		to {
			-moz-transform: rotate(360deg);
		}
	}

	@keyframes pulse {
		0%, 100% {
			transform: scale(inherit) rotate(45deg);
		}
		75% {
			transform: scale(0.25) rotate(45deg);
		}
	}

	@-o-keyframes pulse {
		0%, 100% {
			-o-transform: scale(inherit) rotate(45deg);
		}
		75% {
			-o-transform: scale(0.25) rotate(45deg);
		}
	}

	@-ms-keyframes pulse {
		0%, 100% {
			-ms-transform: scale(inherit) rotate(45deg);
		}
		75% {
			-ms-transform: scale(0.25) rotate(45deg);
		}
	}

	@-webkit-keyframes pulse {
		0%, 100% {
			-webkit-transform: scale(inherit) rotate(45deg);
		}
		75% {
			-webkit-transform: scale(0.25) rotate(45deg);
		}
	}

	@-moz-keyframes pulse {
		0%, 100% {
			-moz-transform: scale(inherit) rotate(45deg);
		}
		75% {
			-moz-transform: scale(0.25) rotate(45deg);
		}
	}
</style>