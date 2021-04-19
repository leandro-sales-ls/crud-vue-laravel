import env from "@/environments.js";
import Axios from "axios";

export default {
    /**
     *
     * @param {*} arr
     * @author Leandro Sales <leandro.sallesls@hotmail.com>
     */
    add(arr) {
        return Axios.post(`${env.domain}${env.usuario}`, arr);
    },
    update(arr, _id) {
        return Axios.put(`${env.domain}${env.usuario}/${_id}`, arr);
    },
    find(_id) {
        return Axios.get(`${env.domain}${env.usuario}/${_id}`);
    },
    findAll() {
        return Axios.get(`${env.domain}${env.usuario}`);
    },
    delete(_id) {
        return Axios.get(`${env.domain}${env.usuarioDelete}/${_id}`);
    },

};
