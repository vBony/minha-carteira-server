import { Express, Request, Response } from "express";
import {User} from '../models/User'
import {sequelize} from '../instances/mysql'

export const home = async (req:Request, res:Response)=>{
    let users = await User.findAll()

    res.send(JSON.stringify(users))
}

export const contato = (req:Request, res:Response)=>{
    res.send('Contato');
}

export const sobre = (req:Request, res:Response)=>{
    res.send('Sobre');
}