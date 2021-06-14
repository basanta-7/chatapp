<template>
	<div class="main-feed">
		<!-- <div
			v-for="post in posts" 
			class="main-feed-card border bg-white my-8">
			<div class="main-feed-card-user-wrapper">
				<div class="main-feed-card-user-section p-1">
					<div class="main-feed-card-user-image">
						<img src="https://placekitten.com/40/40" alt="">
					</div>
					<div class="main-feed-card-user-name mx-2">
						<h3><a href="#">{{post.user.name}}</a></h3>
					</div>
				</div>
				
				<div class="main-feed-card-user-actions px-2">
					<a href="#">
						<img src="https://img.icons8.com/material-sharp/24/000000/dots-loading--v5.png"/>
					</a>
				</div>
			</div>

			<div class="main-feed-card-img">
	            <img :src="'storage/uploads/'+post.image" />			
			</div>

			<div class="main-feed-card-body px-2 py-2">
				<div class="main-feed-card-actions">
            		<a href="#" class="main-feed-card-actions-love mr-2">
            			<img class="h-5" src="https://img.icons8.com/material-outlined/32/000000/filled-like.png"/>
            		</a>  		 
            		<a href="#" class="main-feed-card-actions-comment mr-2">
            			<img class="h-4" src="https://img.icons8.com/metro/24/000000/topic.png"/>
            		</a>  		 
            		<a href="#" class="main-feed-card-actions-love mr-2">
            			<img class="h-4" src="https://img.icons8.com/material-two-tone/24/000000/share.png"/>
            		</a>  		  
				</div>
				<div class="main-feed-card-title mt-1">
            		<h4><strong><a href="#">{{post.user.name}}</a></strong> {{post.title}}</h4>
            		<h5 class="likes-count">3 Likes</h5>  		  
				</div>	
			</div>
		</div> -->

		<div v-for="post in userFeed.data" class="main-feed-card border bg-white my-8">
			<div class="main-feed-card-user-wrapper">
				<div class="main-feed-card-user-section p-1">
					<div class="main-feed-card-user-image">
						<img v-if="post.user.profile_photo_path" :src="'storage/'+post.user.profile_photo_path" alt="">
						<img v-else src='https://avataaars.io/?avatarStyle=Circle&topType=LongHairStraightStrand&accessoriesType=Wayfarers&hairColor=Auburn&facialHairType=Blank&clotheType=ShirtCrewNeck&clotheColor=Heather&eyeType=Hearts&eyebrowType=DefaultNatural&mouthType=Grimace&skinColor=Light' alt="">
					</div>
					<div class="main-feed-card-user-name mx-2">
						<h3><a href="#">{{post.user.name}}</a></h3>
					</div>
				</div>
				
				<div class="main-feed-card-user-actions px-2">
					<a href="#">
						<img src="https://img.icons8.com/material-sharp/24/000000/dots-loading--v5.png"/>
					</a>
				</div>
			</div>

			<div class="main-feed-card-img">
				<img :src="'storage/uploads/'+post.image" alt="">
			</div>

			<div class="main-feed-card-body px-2 py-2">
				<div class="main-feed-card-actions">
            		<a href="#" class="main-feed-card-actions-love mr-2">
            			<img class="h-5" src="https://img.icons8.com/material-outlined/32/000000/filled-like.png"/>
            		</a>  		 
            		<a href="#" class="main-feed-card-actions-comment mr-2">
            			<img class="h-4" src="https://img.icons8.com/metro/24/000000/topic.png"/>
            		</a>  		 
            		<a href="#" class="main-feed-card-actions-love mr-2">
            			<img class="h-4" src="https://img.icons8.com/material-two-tone/24/000000/share.png"/>
            		</a>  		  
				</div>
				<div class="main-feed-card-title mt-1">
            		<h4><strong><a href="#">{{post.user.name}}</a></strong> {{post.title}}</h4>
            		<h5 class="likes-count">3 Likes</h5>  		  
				</div>	
			</div>
		</div>
	</div>
</template>

<script>
	import {debounce} from "lodash/function";

	export default{
		name: 'MainFeed',
		props: {
			posts: Object
		},
		data(){
			return{
				userFeed : this.posts
			}
		},
		mounted(){
			window.addEventListener('scroll', debounce((e) => {
				let pixelsFromBottom = document.documentElement.offsetHeight - document.documentElement.scrollTop - window.innerHeight;
				if(pixelsFromBottom < 200){
					axios.get(this.userFeed.next_page_url)
					.then(response => {
						this.userFeed = {
							...response.data,
							data: [...this.userFeed.data, ...response.data.data]
						}
					});
				}
			}, 100));
		}
	}
</script>