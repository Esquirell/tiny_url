<template>
    <v-app>
        <v-container>
            <v-row class="d-flex justify-content-center">
                <v-card class="mt-4">
                    <v-card-title>
                        <span class="text-h5">Добавить ссылку</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                                >
                                    <v-text-field
                                        label="Введите ссылку"
                                        required
                                        v-model="redirect_url"
                                    ></v-text-field>
                                </v-col>
                                <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                                >
                                    <v-datetime-picker
                                        v-model="datetime"
                                    ></v-datetime-picker>
                                </v-col>
                                <v-col>
                                    <v-btn
                                        @click.prevent="submit"
                                        depressed
                                        color="primary"
                                    >
                                        Добавить
                                    </v-btn>
                                </v-col>
                                <v-col>
                                    <v-btn
                                        href="/url"
                                        depressed
                                        color="primary"
                                    >
                                        Список ссылок
                                    </v-btn>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                </v-card>
            </v-row>
        </v-container>
    </v-app>
</template>
<script>
export default {
    data: () => ({
        datetime: null,
        redirect_url: '',
    }),
    methods: {
        submit() {
            let date = (Date.parse(this.datetime))/1000 + 10800;
            axios.post('/url', {
                redirect_url: this.redirect_url,
                lifetime: date,
            })
                .then(({data}) => {
                    this.redirect_url = '';
                    this.datetime = '';
                })
                .catch((error) => {
                    console.log(this.messages)
                    Swal.fire({
                        icon: 'error',
                        title: 'Ошибка',
                        text: 'Проверьте правильность заполнения полей',
                    })
                });
        }
    }

}
</script>





