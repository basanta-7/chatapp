<template>
    <app-layout>
        <template #header>
        	<h3 class="font-semibold text-xl text-gray-800 leading-tight">
                <GroupChatSelection 
                	:chatRooms="chatRooms"
                	:selectedRoom="activeChatRoom"
                	@roomChanged="setActiveRoom"
                />                
            </h3>
        </template>

        <div class="py-12">
        	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                	<div class="h-96 w-full">
						<div class="h-full p-2 flex-col-reverse overflow-scroll">
							<div v-for="(message, index) in  messages" :key="index">
								<MessageList :message="message" />
							</div>
						</div>
					</div>
					<div class="h-10 m-1">
						<InputMessage :room="activeChatRoom" v-on:messageSent="getMessages()" />
					</div>
                </div>
            </div>
        </div>
	</app-layout>
</template>

<script>
	import InputMessage from './InputMessage.vue';
	import GroupChatSelection from './GroupChatSelection.vue';
	import MessageList from './MessageList.vue';
  import AppLayout from '@/Layouts/AppLayout'
	export default {
        components: {
            AppLayout, InputMessage, MessageList, GroupChatSelection
        },
        data(){
        	return{
        		selected: '',
        		message: '',
        		chatRooms: [],
        		activeChatRoom: [],
        		messages: []
        	}
        },
        watch: {
            activeChatRoom(val, oldVal){
                if(oldVal.id){
                    this.disconnect(oldVal);
                }
                this.connect();
            }
        },
        methods: {
            connect(){
                if(this.activeChatRoom.id){
                    let vm = this;
                    this.getMessages();
                    window.Echo.private("chat."+ this.activeChatRoom.id)
                    .listen(".message.new", e => {
                        vm.getMessages();
                        console.log(e);
                    });
                }
            },
            disconnect(room){
                window.Echo.leave("chat."+room.id);
            },
        	getChatRooms(){
        		axios.get('chat/rooms')
        		.then(response => {
        			this.chatRooms = response.data
        			this.setActiveRoom(response.data[0])
        			this.selected = response.data[0]
        		})
        		.catch(error => console.log(error));
        	},
        	setActiveRoom(room){
        		this.activeChatRoom = room;
        	},
        	getMessages(){
        		axios.get(`/chat/room/${this.activeChatRoom.id}/messages`)
        		.then(response => {
        			this.messages = response.data;
        		})
        		.catch(error => {
        			console.log(error);
        		})
        	},
        	roomChanged(){
        		this.setActiveRoom(this.selected);
        	}
        },
        created(){
        	this.getChatRooms();
        }
    }
</script>