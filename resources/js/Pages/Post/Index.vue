<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Post
                <inertia-link :href="route('posts.create')" class="bg-purple-500 ml-1 p-1 text-sm text-gray-100 rounded hover:bg-blue-400 float-right">Add new</inertia-link>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-sm text-gray-700 font-bold uppercase tracking-wider">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-sm text-gray-700 font-bold uppercase tracking-wider">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-sm text-gray-700 font-bold uppercase tracking-wider">
                                    Created By
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-sm text-gray-700 font-bold uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="(post, index) in posts">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <!-- <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
                                        </div> -->
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{post.id}}.
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">
                                      {{post.title}}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <!-- {{post.created_at}} --> {{post.user.name}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                    <a href="#" class="bg-blue-500 ml-1 p-1 px-2 text-gray-100 rounded hover:bg-blue-400">Edit</a>
                                    <a href="#" class="bg-green-500 ml-1 p-1 px-2 text-gray-100 rounded hover:bg-green-400">View</a>
                                    <a href="#" class="bg-red-500 ml-1 p-1 px-2 text-gray-100 rounded hover:bg-red-400">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
        data: function(){
            return{
                posts: [],
            }
        },
        methods:{
            getPosts(){
                axios.get('/posts')
                .then(response => {
                    this.posts = response.data.data;
                })
                .catch(error => {
                    console.log(error);
                })
            },
            addPost(){
                alert('asdas');
            }
        },
        created(){
            this.getPosts();
            Echo.private('postcreated')
            .listen('NewPostCreated', e => {
                console.log(e);
            })
            console.log(this.posts);
        }
    }
</script>
