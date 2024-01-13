import { Database } from '../models/database';

const dataBase:Database =
  {
    about :
      {
          id:"1",
          photoCover:"https://img.freepik.com/fotos-gratis/paisagem-de-nevoeiro-matinal-e-montanhas-com-baloes-de-ar-quente-ao-nascer-do-sol_335224-794.jpg",
          photoProfile:"https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg",
          name: "Carlos Douglas",
          position: "Desenvolvedor Web Full Stack",
          title: "Hello There",
          description: "",
          socialMedia:[
              {
                id:"1",
                name:"Facebook",
                icon: ""
              },
              {
                id:"2",
                name:"Instagram",
                icon: ""
              },
              {
                id:"3",
                name:"Linkedin",
                icon: ""
              },

          ],
      },
    skills:
    [
      {
        id:'1',
        icon:'',
        name:'Front-end',
        tags:['html','css','js'],
      },
      {
        id:'2',
        icon:'',
        name:'Back-end',
        tags:['php','node','kotlin'],
      },
    ],  
      
  projects:
    [
      {
        id:'1',
        thumbnail:'',
        name:'Achaí',
        tags:['html','css','js','php'],
        description:'Projeto desenvolvido para gerenciar os achados e perdidos do bloco do SMD da UFC',
        repository:'',
        documentation:'',
        videoId:'bhix5Nzoj3I',
      },
      {
        id:'2',
        thumbnail:'',
        name:'Sindicato',
        tags:['html','css','js','php'],
        description:'',
        repository:'',
        documentation:'',
        videoId:'',
      },
    ],  

    settings:
      [
        {
          id:"1",
          appName:"Carlos Portfólio",
        }
      ]

}

export {dataBase}
