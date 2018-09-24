import * as types from './mutation_types'
import request from './request'
export const loginUser = ({commit}, {data}) => {
    request.post('/api/login/', data)
        .then(() => {
            return true
        })
        .catch(error => {
            let errorMessage = error.request + ':Error Sending Reply'
            //commit(types.ERROR_MESSAGE, errorMessage)
            console.log(error)
        })
}
