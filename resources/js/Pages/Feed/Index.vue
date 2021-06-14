<template>
	<div class="main">
		<Header />
		<Stories />
		<div class="main-feed-wrapper my-container">
			<MainFeed :posts="data" />
			<Sidebar />
		</div>
	</div>
</template>

<script>
	import Header from '../../Layouts/Header';
	import Stories from './Stories';
	import Sidebar from './Sidebar';
	import MainFeed from './MainFeed';
	export default{
		name: "Index",
		props: {
			data: Object
		},
		components: {Header, Sidebar, Stories, MainFeed},
	}
</script>

<style></style>