<template>
    <div>

        <header class="top-header">
            <router-link to="/" class="text texta">取消</router-link> 
            <h3>登录</h3>
            <router-link to="regist" class="text">注册</router-link>
        </header>
        
        <div class="login">
            <form>
                <ul>
                    <li>
                        <img src="../assets/images/login.png"/>
                        <label>账号</label>
                        <input type="text" placeholder="请输入账号"/>
                    </li>
                    <li>
                        <img src="../assets/images/password.png"/>
                        <label>密码</label>
                        <input type="password" placeholder="请输入密码"/>
                    </li>
                </ul>
                <input type="submit" value="登录"/>
            </form>
        </div>

    </div>
</template>


