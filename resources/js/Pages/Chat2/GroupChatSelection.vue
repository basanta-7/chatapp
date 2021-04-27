<template>
	<div>
		Select Group
        <select v-model="selectedRoom" @change="roomChanged()" class="ml-3">
        	<option v-for="(chatRoom, index) in chatRooms" :key="index" :value="chatRoom">{{chatRoom.name}}</option>
        </select>
	</div>
</template>

<script>
	export default{
		name: 'GroupChatSelection',
		props: ['chatRooms', 'selectedRoom'],
		data(){
			return{
			}
		},
		methods: {
			roomChanged(){
				this.$emit('roomChanged',this.selectedRoom);
			}
		},
	}
</script>