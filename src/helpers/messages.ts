class messageHelper {
    static get(errors:any): any{
        Object.entries(errors).forEach((entry:any) => {
            const [key, value] = entry
    
            delete errors[value['param']]
            errors[value['param']] = value['msg']
        });
        
        return errors
    }
}

export default messageHelper