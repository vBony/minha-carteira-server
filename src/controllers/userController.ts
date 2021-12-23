import { Request, Response } from "express";
import {User} from '../models/User'
import { validationResult, matchedData } from "express-validator";
import msg from "../helpers/messages";


export async function signup(req: Request, res: Response) {
    let errors = validationResult(req);

    if (!errors.isEmpty()) {
        res.json({errors: msg.get(errors.mapped())})
    }else{
        const data = req.body
        const userByEmail = await User.findOne({where: {email: data.email}})

        if(userByEmail === null){

        }else{
            res.json({errors: {email: 'E-mail já está sendo utilizado'}})
        }
    }
}