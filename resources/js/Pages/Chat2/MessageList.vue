<template>
	<div>
		<b>{{message.user.name}} : </b> {{message.message}}
	</div>
</template>

<script>
	export default{
		name: 'MessageList',
		props: ['message'],
		data(){
			return {

			}
		},
		methods: {

		}
	}
</script>