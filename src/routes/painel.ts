import {Router, Request, Response} from 'express'

const router = Router()


router.get('/', (req:Request, res:Response)=>{
    res.send('Home');
})

router.get('/noticias', (req:Request, res:Response)=>{
    res.send('Lista de noticias');
})

router.get('/usuarios', (req:Request, res:Response)=>{
    res.send('Lista de usuários');
})

export default router