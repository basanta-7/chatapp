<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <chatRoomselection 
                    v-if="currentRoom.id"
                    :rooms="chatRooms"
                    :currentRoom="currentRoom"
                    v-on:roomChanged="setRoom($event)"
                />
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <messageContainer  
                        :messages="messages"
                    />
                    <inputMessage :room="currentRoom" v-on:messagesent="getMessages()" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import inputMessage from './inputMessage'
    import chatRoomselection from './chatRoomselection'
    import messageContainer from './messageContainer'
    
    export default {
        components: {
            AppLayout,
            messageContainer,
            inputMessage
        },
        data: function(){
            return {
                chatRooms: [],
                currentRoom: [],
                messages: [],
            }
        },
        methods: {
            getRooms(){
                axios.get('/chat/rooms')
                .then(response => {
                    this.chatRooms = response.data;
                    this.setRoom(response.data[0]);
                })
                .catch( error => {
                    console.log(error);
                })
            },
            setRoom(room){
                this.currentRoom = room;
                this.getMessages();
            },
            getMessages(){
                axios.get('/chat/room/'+ this.currentRoom.id + '/messages')
                .then(response => {
                    this.messages = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
            }
        },
        created(){
            this.getRooms();
        }
    }
</script>
