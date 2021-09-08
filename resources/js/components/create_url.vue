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
                                        :error-messages="url_error"
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
                                        :textFieldProps="textFieldProps"
                                        label="Время жизни"
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
        textFieldProps: {
            "error-messages": '',
        },
        url_error: [],
    }),
    methods: {
        submit() {
            let date = (Date.parse(this.datetime))/1000 + 10800;
            axios.post('/url', {
                redirect_url: this.redirect_url,
                lifetime: date,
            })
                .then(({data}) => {
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    this.redirect_url = '';
                    this.datetime = '';
                    this.textFieldProps["error-messages"] = '';
                })
                .catch((error) => {
                    let errors = error.response.data.errors
                    this.textFieldProps["error-messages"] = errors.lifetime
                    this.url_error = errors.redirect_url
                    console.log(errors)
                    console.log(this.textFieldProps);
                });
        }
    }
}
</script>





