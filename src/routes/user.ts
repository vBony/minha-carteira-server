import {Router} from 'express'
import * as userController from '../controllers/userController'
import * as authValidator from '../validators/authValidator'

const router = Router()

router.post('/signup', authValidator.register, userController.signup)

export default router