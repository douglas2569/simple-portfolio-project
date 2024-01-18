import { Component, OnInit, Input } from '@angular/core';
import {Tag} from '../../models/database'

@Component({
  selector: 'app-project',
  templateUrl: './project.component.html',
  styleUrls: ['./project.component.css']
})

export class ProjectComponent implements OnInit {
  @Input()
  id!:string
  @Input()
  thumbnail!:string
  @Input()
  name!:string
  @Input()
  tags!:Array<Tag>

  constructor() { }

  ngOnInit(): void {
    
  }



}
