import { Model, DataTypes } from 'sequelize'
import { sequelize } from '../instances/mysql'

export interface UserInstance extends Model {
    id: number
    name: string
    lastName: string
    email: string
    job: string
    photo: string
    creationDate: string
}

export const User = sequelize.define<UserInstance>('EUser', {
    id: {
        primaryKey: true,
        autoIncrement: true,
        type: DataTypes.INTEGER,
        field: 'usu_id'
    },
    name: {
        type: DataTypes.STRING,
        field: 'usu_nome'
    },
    lastName: {
        type: DataTypes.STRING,
        field: 'usu_sobrenome'
    },
    email: {
        type: DataTypes.STRING,
        field: 'usu_email'
    },
    job: {
        type: DataTypes.STRING,
        field: 'usu_profissao'
    },
    photo: {
        type: DataTypes.STRING,
        field: 'usu_foto'
    },
    creationDate: {
        type: DataTypes.STRING,
        field: 'usu_data_criacao'
    },
}, {
    tableName: 'usuario',
    timestamps: false
})