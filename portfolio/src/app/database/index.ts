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
          title: "Olá meu povo.",
          description: "Seja bem-vindo ao meu mundo digital, onde a paixão pela tecnologia e a busca incessante por soluções inovadoras se encontram. Sou um desenvolvedor Full Stack comprometido, sempre pronto para enfrentar os desafios do universo tecnológico. Com uma sólida formação em Ciência da Computação e uma extensa experiência prática, trago uma abordagem abrangente e integrada para o desenvolvimento de software.",
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
        icon:'../assets/images/front-end.png',
        name:'Front-end',
        tags:['html','css','js'],
      },
      {
        id:'2',
        icon:'../assets/images/back-end.png',
        name:'Back-end',
        tags:['php','node','kotlin'],
      },

      {
        id:'3',
        icon:'../assets/images/mobile.png',
        name:'Mobile',
        tags:['react-native','kotlin'],
      },
    ],

  projects:
    [
      {
        id:'1',
        thumbnail:'',
        name:'Achaí',
        tags:[
          {
            id:'1',
            name:'html',
            color:'gray'
          },
          {
            id:'2',
            name:'css',
            color:'purple'
          },
          {
            id:'3',
            name:'js',
            color:'yellow'
          }

        ],
        description:'Projeto desenvolvido para gerenciar os achados e perdidos do bloco do SMD da UFC',
        repository:'',
        documentation:'',
        videoId:'bhix5Nzoj3I',
      },
      {
        id:'2',
        thumbnail:'',
        name:'Sindicato',
        tags:[
          {
            id:'1',
            name:'html',
            color:'gray'
          },
          {
            id:'2',
            name:'css',
            color:'purple'
          },
          {
            id:'3',
            name:'js',
            color:'yellow'
          }

        ],
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
