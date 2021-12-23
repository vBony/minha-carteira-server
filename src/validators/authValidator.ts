import { checkSchema } from "express-validator";

export const register = checkSchema ({
    name: {
        trim: true,
        notEmpty: {
            bail: true,
            errorMessage: 'Campo obrigatório'
        },
        isLength: {
            options: { min: 2 },
            errorMessage: "Digite um nome maior que 2 caracteres",
        },
    },
    lastName: {
        trim: true,
    },
    password: {
        isLength: {
            options: { min: 3 },
            errorMessage: "Digite uma senha maior que 3 caracteres"
        }
    },
    email: {
        normalizeEmail: true,
        notEmpty: {
            bail: true,
            errorMessage: 'Campo obrigatório'
        },
        isEmail: true,
        errorMessage: 'E-mail inválido'
    },

    
})
