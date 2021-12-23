import express, {Request, Response} from 'express'
import mainRoutes from './routes/index'
import painelRoutes from './routes/painel'
import userRoutes from './routes/user'
import dotenv from 'dotenv'
import cors from 'cors'
import bodyParser from 'body-parser'


dotenv.config()

const server = express()
server.use(express.json())
server.use(cors({
    origin: '*'
}))

server.use(bodyParser.urlencoded({ extended: false }));

// acessa <ur>/imgs/test.jpg
server.use(express.static('public'))

server.use('/', mainRoutes)
// server.use('/painel', painelRoutes)
server.use('/user', userRoutes)

server.use((req: Request, res: Response) => {
    res.status(404).send('Página nao encontrada')
})

server.listen(process.env.PORT)