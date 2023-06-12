
class ServerSide {

    constructor() {
        this.form = new FormData();
        this.url;
        this.container;
        this.text;
        this.method;
    }
    do(func) {
        func();
    }
    async sendPostRequest(func) {
        const res = await fetch(this.url, { body: this.form, method: this.method });
        const text = await res.text();
        this.text = text;
        this.do(func);
    }
    async sendGetRequest(func) {
        const res = await fetch(this.url);
        const text = await res.text();
        this.text = text;
        this.do(func);
    }


}
