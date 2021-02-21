<html>
<body>
    <div id="chat">
        <textarea v-model="message"></textarea>
        <br>
        <button type="button" @click="send()">送信</button>
        <div v-for="m in messages">
            <!-- 登録された日時 -->
            <span v-text="m.created_at"></span>：&nbsp;

            <!-- メッセージ内容 -->
            <span v-text="m.body"></span>
        </div>
    </div>
<script type="text/javascript">
<!--
var subWinObj3;     // サブウインドウオブジェクト

function cman_winOpen3(){
	if( (subWinObj3) && (!subWinObj3.closed) ){        // サブウインドウが開いている場合一旦CLOSEする
		subWinObj3.close();
	}
	subWinObj3 = window.open("http://localhost/otopita/public/chat", 'sample3','top=0,left=0,height=400,width=520,resizable=yes, scrollbars=yes');
	subWinObj3.blur();      // サブウインドウにフォーカスを設定する
	window.focus();         // 自画面からフォーカスを取得
	window.blur();          // 自画面からフォーカスを放す
	subWinObj3.focus();     // サブウインドウにフォーカスを設定する
}
-->
</script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script src="js/app.js"></script>
<script>
new Vue({
            el: '#chat',
            data: {
                message: '',
                messages: []
            },
            methods: {
                getMessages() {
                    const url = '/otopita/public/ajax/chat';
                    axios.get(url)
                        .then((response) => {
                            console.log(response.data);
                            this.messages = response.data;
                        });

                },
                send() {

                    const url = '/otopita/public/ajax/chat';
                    const params = { message: this.message };
                    axios.post(url, params)
                        .then((response) => {

                            // 成功したらメッセージをクリア
                            this.message = '';
                        });

                }
            },
            mounted() {
                this.getMessages();
                Echo.channel('chat').listen('MessageCreated', (e) => {
                    this.getMessages(); // 全メッセージを再読込
                    cman_winOpen3();
                });
            }
        });

    </script>
</body>
</html>