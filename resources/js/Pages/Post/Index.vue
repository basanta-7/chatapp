<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Post
                <inertia-link :href="route('post.create')" class="bg-purple-500 ml-1 p-1 text-sm text-gray-100 rounded hover:bg-blue-400 float-right">Add new</inertia-link>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div v-if="$page.props.flash.message" class="p-2 mb-5 bg-green-500 text-white rounded pull-right">
                    {{ $page.props.flash.message }}
                </div>

                <!-- <div class="text-center">
                    <div class="trinity-rings-spinner my-1">
                      <div class="circle"></div>
                      <div class="circle"></div>
                      <div class="circle"></div>
                    </div>
                </div> -->

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
                            <tr v-for="(post, index) in posts.data">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
                                        </div>
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
                                    <inertia-link :href="route('post.edit',post.id)" class="bg-blue-500 ml-1  p-1 px-2 text-gray-100 rounded hover:bg-blue-400">Edit</inertia-link>
                                    <a href="#" class="bg-green-500 ml-1 p-1 px-2 text-gray-100 rounded hover:bg-green-400">View</a>
                                    <a @click="deletePost(post)" href="#" class="bg-red-500 ml-1 p-1 px-2 text-gray-100 rounded hover:bg-red-400">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                      <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                            Showing
                            <span class="font-medium">{{posts.from}}</span>
                            to
                            <span class="font-medium">{{posts.to}}</span>
                            of
                            <span class="font-medium">{{posts.total}}</span>
                            results
                             </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <div v-for="link in posts.links">
                                    <inertia-link   
                                        :class="['relative', 'inline-flex', 'items-center', 'px-4', 'py-2', 'border', 'border-gray-300', 'bg-white', 'text-sm', 'font-medium', 'text-gray-700', 'hover:bg-gray-50', 
                                        link.url === null ? 'disabled' : '',
                                        link.active ? 'active' : ''
                                        ]"
                                        :href="link.url == null ? 'javascript:;' : link.url"
                                    >
                                        {{link.label}}
                                    </inertia-link>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout
        },
        props: ['posts'],
        methods:{
            deletePost(post){
                if(confirm('Are you sure to delete this ?')){
                    post._method = 'DELETE';
                    this.$inertia.post(`/post/${post.id}`, post);
                }
            }
        },
        created(){
            console.log(this.posts);
        }
    }
</script>

<style>
    .trinity-rings-spinner, .trinity-rings-spinner * {
      box-sizing: border-box;
    }

    .trinity-rings-spinner {
      height: 66px;
      width: 66px;
      padding: 3px;
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: row;
      overflow: hidden;
      box-sizing: border-box;
    }
    .trinity-rings-spinner .circle {
      position:absolute;
      display:block;
      border-radius:50%;
      border: 3px solid gray;
      opacity: 1;
    }

    .trinity-rings-spinner .circle:nth-child(1) {
      height: 60px;
      width: 60px;
      animation : trinity-rings-spinner-circle1-animation 1.5s infinite linear;
      border-width: 3px;
    }
    .trinity-rings-spinner .circle:nth-child(2) {
      height: calc(60px * 0.65);
      width: calc(60px * 0.65);
      animation : trinity-rings-spinner-circle2-animation 1.5s infinite linear;
      border-width: 2px;
    }
    .trinity-rings-spinner .circle:nth-child(3) {
      height: calc(60px * 0.1);
      width: calc(60px * 0.1);
      animation:trinity-rings-spinner-circle3-animation 1.5s infinite linear;
      border-width: 1px;
    }

    @keyframes trinity-rings-spinner-circle1-animation{
      0% {
        transform: rotateZ(20deg) rotateY(0deg);
      }
      100% {
        transform: rotateZ(100deg) rotateY(360deg);
      }
    }
    @keyframes trinity-rings-spinner-circle2-animation{
      0% {
        transform: rotateZ(100deg) rotateX(0deg);
      }
      100% {
        transform: rotateZ(0deg) rotateX(360deg);
      }
    }
    @keyframes trinity-rings-spinner-circle3-animation{
      0% {
        transform: rotateZ(100deg) rotateX(-360deg);
      }
      100% {
        transform: rotateZ(-360deg) rotateX(360deg);
      }
    }
</style>