<template>
    <div>
        <router-link to="/hello/tom">HelloTom</router-link> |
        <router-link to="/hello/jack">HelloJack</router-link>

        <router-view></router-view>

        <h1>Hello World ~</h1>
        <!-- 使用组件 -->
        <say-hello></say-hello>    
        <hello-world></hello-world>
    </div>
</template>


<style>
    h1 {
        color: green;
    }
</style>


<script>

// 引入组件
import SayHello from '@/components/SayHello.vue'
import HelloWorld from '@/components/HelloWorld.vue'
export default {
    // 注册组件
    components: {
        SayHello,
        HelloWorld
    }
}
</script>

