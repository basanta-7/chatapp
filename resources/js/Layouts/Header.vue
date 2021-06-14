<template>
	<header>
		<section class="bg-white py-3 w-full border">
			<div class="nav-container">
				<div class="navbar">
					<div class="nav-logo">
						<h2>Cattogram</h2>
					</div>
					<div class="nav-search">
						<input type="text" class="search-text border rounded" placeholder="Search">
					</div>
					<div class="nav-right">
						<div class="nav-right-item home">
							<a href="#">
								<img src="https://img.icons8.com/material-sharp/24/000000/home.png"/>
							</a>
						</div>
						<div class="nav-right-item messenger">
							<a href="#">
								<img src="https://img.icons8.com/material-rounded/24/000000/facebook-messenger--v1.png"/>
							</a>
						</div>
						<div class="nav-right-item explore">
							<a href="#">
								<img src="https://img.icons8.com/material-outlined/24/000000/compass.png"/>
							</a>
						</div>
						<div class="nav-right-item love">
							<a href="#">
								<img src="https://img.icons8.com/material-rounded/24/000000/filled-like.png"/>
							</a>
						</div>
						<div class="nav-right-item love">
							<a href="#">
                                <img class="h-7 w-7 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>			
	</header>
</template>

<script>
	export default{
		name: "Header"
	}
</script>