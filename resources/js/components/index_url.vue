<template>
    <v-app>
        <v-container>
            <div class="d-flex justify-content-center mb-3 mt-3">
                <v-btn
                    href="/url/create"
                    depressed
                    color="primary"
                >
                    На главную
                </v-btn>
            </div>
            <v-data-table
                :headers="headers"
                :items="items"
                :items-per-page="5"
                class="elevation-1"
            >
                <template v-slot:item.url="{ item }">
                    <a
                        target="_blank"
                        :href="item.url">
                        {{item.url}}
                    </a>
                </template>
            </v-data-table>
        </v-container>
    </v-app>
</template>
<script>
export default {
    data: () => ({
        headers: [
            {
                text: 'Сокращенная ссылка',
                align: 'start',
                sortable: false,
                value: 'url',
            },
            { text: 'Ссылка', value: 'redirect_url' },
            { text: 'Время жизни', value: 'lifetime' },
            { text: 'Количество переходов', value: 'transition' },
        ],
        items: [],
        redirect_url: '',
    }),
    mounted() {
        this.loadUrl();
    },
    methods: {
        loadUrl() {
            axios.get('/api/get-url')
                .then(({data}) => {
                    console.log(data)
                    this.items = data
                    for (let i = 0; i < this.items.length; i += 1) {
                        this.items[i].url = 'http://127.0.0.1:8000/' + this.items[i].url;
                    }
                });
        }
    }
}
</script>





