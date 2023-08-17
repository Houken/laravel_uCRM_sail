<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue'

onMounted(() => {
    axios.get('/api/user')
    .then( res => {
        console.log(res)
    })
})


// boolean型の変数 初期値がfalse
// クリックしたらtrueに変わる
const isShow = ref(false)
const toggleStatus = () => { isShow.value = !isShow.value }
</script>

<template>
    <!-- [1] -->
    <!-- モーダルの最外部のコンテナ -->
    <!-- モーダルのdisplayを切り替え -->
    <div id="modal-1" aria-hidden="true" class="modal" v-show="isShow">
        <!-- [2] -->
        <!-- モーダルのオーバーレイ -->
        <!-- data-micromodal-closeが必須 -->
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <!-- [3] -->
            <!-- 以下のコンテンツはページの他から分離していることをroleが説明 -->
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                    <h2 class="modal__title" id="modal-1-title">
                        Micromodal
                    </h2>
                    <!-- [4] -->
                    <!-- aria-labelがボタンのアクションを定義 -->
                    <!-- 「閉じる」ボタンにdata-micromodal-closeを置く -->
                    <button type="button" class="modal__close" aria-label="Close modal" data-micromodal-close
                        @click="toggleStatus"></button>
                </header>
                <main class="modal__content" id="modal-1-content">
                    <p>
                        Try hitting the <code>tab</code> key and notice how the focus stays within the modal itself. Also,
                        <code>esc</code> to close modal.
                    </p>
                </main>
                <footer class="modal__footer">
                    <button @click="toggleStatus" type="button" class="modal__btn modal__btn-primary">Continue</button>
                    <button @click="toggleStatus" type="button" class="modal__btn" data-micromodal-close
                        aria-label="Close this dialog window">Close</button>
                </footer>
            </div>
        </div>
    </div>

    <button @click="toggleStatus" type="button" data-micromodal-trigger="modal-1"
        href='javascript:;'>Open Modal Dialog</button>
</template>
