export default function({ $axios, redirect, store }) {
    $axios.onError(error => {
        throw error.response;
    });

    $axios.onRequest(config => {
    });

    $axios.onResponse(response => {
        return response;
    });
}