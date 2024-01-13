import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-project',
  templateUrl: './project.component.html',
  styleUrls: ['./project.component.css']
})

export class ProjectComponent implements OnInit {  
  @Input()
  thumbnail!:string
  @Input()
  name!:string
  @Input()
  tags!:Array<string>  

  constructor() { }
  
  ngOnInit(): void {}

  

}
