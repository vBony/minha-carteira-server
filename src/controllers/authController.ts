import { Request, Response } from "express";
import {User} from '../models/User'
import { validationResult, matchedData } from "express-validator";

export const login = async (req:Request, res:Response)=>{
    let users = await User.findAll()

    res.send(JSON.stringify(users))
}

export async function register(req: Request, res: Response) {
    const errors = validationResult(req);

    if (!errors.isEmpty()) {
        res.json({ error: errors.mapped() });
    }

    res.json({ status: 'success!' });
}

export async function getRegister(req: Request, res: Response) {
    let nome = req.params.name

    res.json({name: nome})
}